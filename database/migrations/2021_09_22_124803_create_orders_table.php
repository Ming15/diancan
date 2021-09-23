<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('用户id');
            $table->unsignedBigInteger('shop_id')->comment('商铺id');
            $table->string('order_no')->comment('订单号');
            $table->string('address')->nullable()->comment('收货地址');
            $table->decimal('total_price',10,2)->comment('订单总金额');
            $table->string('remark')->nullable()->comment('订单备注');
            $table->timestamp('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_method')->nullable()->comment('支付方式');
            $table->string('payment_no')->nullable()->comment('支付平台订单号');
            $table->tinyInteger('status')->default(0)->comment('订单状态，0待支付，1已完成（已支付），2已取消，3退款售后 4已关闭');
            $table->tinyInteger('order_type')->default(0)->comment('0送餐到桌，1打包外带');
            $table->timestamp('take_time')->nullable()->comment('自取时间');
            $table->tinyInteger('desk_num')->nullable()->comment('桌台号');
            $table->text('order_info')->comment('下订单时候的商品信息');
            $table->index('order_no');
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
        Schema::dropIfExists('orders');
    }
}
