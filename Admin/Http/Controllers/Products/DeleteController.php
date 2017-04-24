<?php

namespace Bitaac\Admin\Http\Controllers\Products;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    /**
     * Show delete store product form to user.
     *
     * @param  \Bitaac\Store\Models\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function form(StoreProduct $product)
    {
        return view('admin::products.delete')->with(compact('product'));
    }

    /**
     * Handle delete store product request.
     *
     * @param  \Bitaac\Store\Models\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function post(StoreProduct $product)
    {
        $product->delete();

        return redirect('/admin/products')->withSuccess('Your product has been deleted.');
    }
}
