<?php

namespace Bitaac\Admin\Http\Controllers\Products;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Products\EditRequest;

class EditController extends Controller
{
    /**
     * Show add product form to user.
     *
     * @param  \Bitaac\Store\Models\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function form(StoreProduct $product)
    {
        return view('admin::products.edit')->with(compact('product'));
    }

    /**
     * Handle add product request.
     *
     * @param  \Bitaac\Store\Models\StoreProduct                 $product
     * @param  \Bitaac\Admin\Http\Requests\Products\EditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(EditRequest $request, StoreProduct $product)
    {
        $product->title = $request->get('title');
        $product->item_id = $request->get('item_id');
        $product->item_count = $request->get('amount');
        $product->points = $request->get('points');
        $product->description = $request->get('description');
        $product->save();

        return redirect('/admin/products')->withSuccess('Your changes were saved.');
    }
}
