<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->comment('订单id');
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->unsignedBigInteger('product_sku_id')->comment('所属商品sku id');
            $table->integer('num')->comment('数量');
            $table->decimal('price', 10, 2)->comment('单价');
            $table->tinyInteger('refund_status')->default(0)->nullable()->comment('退款状态，0 未退款 1 已申请退款 2 退款中 3退款成功 4退款失败');
            $table->string('refund_no')->nullable()->comment('退款单号');
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
        Schema::dropIfExists('order_items');
    }
}
