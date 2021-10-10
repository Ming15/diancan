<?php

namespace App\Http\Requests;


class CreateOrderRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_skus' => ['required', 'array'],
            'product_skus.*.product_sku_id' => ['required', 'numeric'],
            'product_skus.*.num' => ['required', 'integer', 'min:1'],
            'remark' => ['sometimes', 'max:50']
        ];
    }

    public $attributes = [
        'remark' => '备注'
    ];
}
