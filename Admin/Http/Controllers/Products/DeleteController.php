<?php

namespace Bitaac\Admin\Http\Controllers\Products;

use Bitaac\Contracts\StoreProduct;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
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
     * Show the delete store product page.
     *
     * @param  \Bitaac\Contracts\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function form(StoreProduct $product)
    {
        return view('admin::products.delete')->with([
            'product' => $product,
        ]);
    }

    /**
     * Handle the delete store product request.
     *
     * @param  \Bitaac\Contracts\StoreProduct  $product
     * @return \Illuminate\Http\Response
     */
    public function post(StoreProduct $product)
    {
        $product->delete();

        return redirect()->route('admin.products')->with([
            'success' => 'Your product has been deleted.',
        ]);
    }
}
