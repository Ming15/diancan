<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductSkuController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Product $product, Request $request)
    {
        $arrtibutes = $request->input('attributes');

        $result = $product->productSkus()
            ->whereJsonContains('attributes', $arrtibutes)
            ->first(['id', 'product_id', 'title', 'price', 'ot_price', 'image']);

        return $this->success($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
