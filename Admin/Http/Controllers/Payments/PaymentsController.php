<?php

namespace Bitaac\Admin\Http\Controllers\Payments;

use Bitaac\Store\Models\Payment;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Products\CreateRequest;

class PaymentsController extends Controller
{
    /**
     * Show payment logs to user.
     *
     * @param  \Bitaac\Store\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function index(Payment $payment)
    {
        return view('admin::payments.index')->with([
            'payments' => $payment->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
