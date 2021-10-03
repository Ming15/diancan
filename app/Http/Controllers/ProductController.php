<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class ProductController extends Controller
{
    use ApiResponse;

    public function index()
    {
        // TODO 月售没做，现在只展示了总销量
        $result = ProductCategory::with(['products' => function ($query) {
            return $query->where('on_sale', 1)->select('id', 'category_id', 'product_name', 'unit_name', 'price', 'sales', 'spec_type', 'image');
        }])->get(['id', 'category_name']);

        return $this->success($result);
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
    public function show(Product $product)
    {
        // TODO 商品的价格不能直接读表，应该是当前默认选中的规格的价格
        $attributes = $product->productSkus()->get(['attributes'])->pluck('attributes')->transform(function ($value) {
            $value = json_decode($value, true);
            return $value;
        })->toArray();

        // 取出商品的规格
        $proAttributes = $product->load(['skuAttributes' => function($query) {
            return $query->select(['id', 'product_id', 'attribute_name']);
        }])
            ->where('on_sale', 1)
            ->select(['id', 'product_name', 'product_desc', 'image', 'slider_image', 'unit_name', 'price'])
            ->get();

        $proAttributes->transform(function ($value) use ($attributes) {
            $value->skuAttributes->transform(function ($skuAttribute) use ($attributes) {
                $attr = collect();

                foreach ($attributes as $item) {
                    foreach ($item as $res) {
                        if ($skuAttribute['id'] == $res['id']) {
                            $attr->push($res['value']);
                        }
                    }
                }

                $skuAttribute['attributes']= $attr;
                return $skuAttribute;
            });

            $value = collect($value)->except(['image', 'slider_image']);
            return $value;
        });

         return $this->success($proAttributes);
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
