<?php

namespace Bitaac\Admin\Http\Controllers\Products;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Products\CreateRequest;

class CreateController extends Controller
{
    /**
     * Show add product form to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('admin::products.create');
    }

    /**
     * Handle add product request.
     *
     * @param  \Bitaac\Admin\Http\Requests\Products\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(CreateRequest $request, StoreProduct $product)
    {
        $product = new $product;
        $product->title = $request->get('title');
        $product->item_id = $request->get('item_id');
        $product->item_count = $request->get('amount');
        $product->points = $request->get('points');
        $product->description = $request->get('description');
        $product->save();

        return redirect('/admin/products')->withSuccess('Your product has been added.');
    }
}
