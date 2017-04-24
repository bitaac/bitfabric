<?php

namespace Bitaac\Admin\Http\Controllers\Products;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Products\CreateRequest;

class ProductsController extends Controller
{
    /**
     * Show all store products to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreProduct $products)
    {
        return view('admin::products.index')->with([
            'products' => $products->get(),
        ]);
    }
}
