<?php

namespace App\Http\Controllers;

use App\Models\ProductSku;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ApiResponse;

    // 微信小程序登录
    public function login(Request $request)
    {
        $code = $request->input('code');
//        $info = app('miniProgram')->auth->session($code);
        $user = User::find(1);
        $token = auth('api')->login($user);

        return $this->success($token);
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
    public function show()
    {
//        $result = ProductSku::create([
//            'product_id' => 1,
//            'title' => '大,热',
//            'sales' => 0,
//            'stock' => 0,
//            'price' => 20,
//            'ot_price' => 20,
//            'image' => 'storage/app/public/yuyuan.jpg',
//            'attributes' => json_encode([
//                ['id' => 1, 'value' => '大'],
//                ['id' => 2, 'value' => '热'],
//            ])
//        ]);
//        dd($result);

        $userinfo = auth('api')->user();
        $userinfo = collect($userinfo)->except('phone');

        return $this->success($userinfo);
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
