<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->string('title')->comment('sku名称'); // 例如：64G,白色
            $table->integer('sales')->unsigned()->default(0)->comment('销量');
            $table->integer('stock')->unsigned()->default(0)->comment('库存');
            $table->decimal('price',10,2)->comment('属性价格');
            $table->string('image')->comment('图片');
            $table->json('attributes')->comment('规格与sku对应的值');
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
        Schema::dropIfExists('product_skus');
    }
}
