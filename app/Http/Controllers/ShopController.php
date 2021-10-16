<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ShopController extends Controller
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
    public function show(ShopRequest $request, Shop $shop, $id)
    {
        // 1.获取前端传过来的当前用户的经纬度，检测redis有无存储，有则替换，无则替换
        // 2.获取当前商铺的在redis有无存储，有则不管，无则新增
        // 3.计算距离并返回，键：address，shop:1 user:1
        $user = auth('api')->user();
        $shop = $shop::query()->first();
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        Redis::geoadd('address', $longitude, $latitude, 'user:'.$user['id']);

        if (!Redis::geopos('address', 'shop:'.$shop['id'])[0]) {
            if ($shop['longitude'] && $shop['latitude']) {
                Redis::geoadd('address', $shop['longitude'], $shop['latitude'], 'shop:'.$shop['id']);
            }
        }

        // 对距离的数据格式进行处理
        $shop['distance_unit'] = 'm';
        $distance = Redis::geodist('address', 'user:'.$user['id'], 'shop:'.$shop['id']);
        if (!$distance) {
            $distance = '';
        } else {
            $distanceArr = explode('.', $distance);
            if (strlen($distanceArr[0]) >= 4) {
                $distance = bcdiv($distance, 1000, 4);
                $shop['distance_unit'] = 'km';
            }
        }

        $shop['distance'] = $distance;

        return $this->success($shop);
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
