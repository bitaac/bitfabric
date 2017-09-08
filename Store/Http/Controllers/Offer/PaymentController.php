<?php

namespace Bitaac\Store\Http\Controllers\Offer;

use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Bitaac\Store\Models\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Show the paypal offers to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($gateway)
    {
        $gateway = config("bitaac.store.gateways.$gateway");

        if (! $gateway or ! $gateway['enabled']) {
            return redirect('/store/offers');
        }

        return view('bitaac::store.offers.form')->with([
            'gateway' => (object) $gateway,
        ]);
    }

    /**
     * Create & Process the payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, $provider)
    {
        // Verify that the amount exists as a offer.
        if (! isset(config("bitaac.store.gateways.$provider.offers")[$request->get('amount')])) {
            return back()->withErrors('Something went wrong, please try again.');
        }

        $config = (object) config("bitaac.store.gateways.$provider");

        $gateway = Omnipay::create($config->omnipay);

        $params = [
            'clientId'      => $config->client,
            'secret'        => $config->secret,
            'testMode'      => $config->sandbox,
            'returnUrl'     => route('gateway.return', ['gateway' => $provider]),
            'cancelUrl'     => route('gateway.cancel', ['gateway' => $provider]),
            'amount'        => $request->get('amount'),
            'currency'      => $config->currency,
            'description'   => $config->description,
        ];

        $gateway->initialize($params);

        $response = $gateway->purchase($params)->send();

        $request->session()->put('params', $params);
        $request->session()->put('transactionReference', $response->getTransactionReference());

        return $response->getRedirectResponse();
    }

    /**
     * Complete the payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function return(Request $request, $provider)
    {
        $config = (object) config("bitaac.store.gateways.$provider");

        $gateway = Omnipay::create($config->omnipay);

        $params = $request->session()->get('params');

        $gateway->initialize($params);

        $transaction = $gateway->completePurchase(array_merge($request->session()->get('params'), [
            'transactionReference' => $request->session()->get('transactionReference'),
            'payerId' => $request->get('PayerID'),
        ]));

        $response = $transaction->send();

        // Make sure the payment was successful.
        if (! $response->isSuccessful()) {
            return back()->withErrors('Something went wrong.');
        }

        $data = (object) $response->getData();

        $payment = Payment::where(function ($query) use ($data, $provider) {
            $query->where('payment_id', $data->id);
            $query->where('method', $provider);
        });

        // Make sure the payment already has been processed
        if ($payment->exists()) {
            return back()->withErrors('Payment has already been processed.');
        }

        $payment = new Payment;
        $payment->payment_id = $data->id;
        $payment->method = $provider;
        $payment->currency = $transaction->getCurrency();
        $payment->amount = $transaction->getAmount();
        $payment->account_id = auth()->user()->id;
        $payment->points = config("bitaac.store.gateways.$provider.offers")[$transaction->getAmount()];
        $payment->save();

        $user = auth()->user()->bitaac;
        $user->points = $user->points + $payment->points;
        $user->total_points = $user->total_points + $payment->points;
        $user->save();

        return redirect('/store')->withSuccess("Thanks for your purchase, {$payment->points} points has been added to your account.");
    }

    /**
     * Cancel the payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return redirect('/store/offers')->withError('The payment transaction has been cancelled.');
    }
}
