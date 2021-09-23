<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 这个购物车表在点餐项目里面应该是用不到的
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('用户id');
            $table->unsignedBigInteger('sku_id')->comment('商品sku id');
            $table->integer('num')->default(0)->comment('数量');
            $table->text('cart_info')->comment('购物车信息'); //记录加入购物车的时候商品的信息，用作商品被删除还能看到商品的信息
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
