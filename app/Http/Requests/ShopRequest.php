<?php

namespace App\Http\Requests;


class ShopRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if ($this->route()->getName() == 'shops.show') {
            $rules = [
                'longitude' => ['required'],
                'latitude' => ['required'],
            ];
        }

        return $rules;
    }

}
