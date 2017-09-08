<?php

namespace Bitaac\Admin\Http\Controllers\Products;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    /**
     * Show the store products page.
     *
     * @param  \Bitaac\Contracts\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function index(StoreProduct $product)
    {
        return view('admin::products.index')->with([
            'products' => $product->all(),
        ]);
    }
}
