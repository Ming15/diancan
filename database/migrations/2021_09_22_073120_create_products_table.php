<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->comment('分类id');
            $table->string('product_name')->comment('商品名称');
            $table->text('product_desc')->comment('商品详情');
            $table->string('image')->comment('封面图片');
            $table->string('slider_image',2000)->comment('轮播图');
            $table->string('unit_name')->comment('单位名称');
            $table->boolean('on_sale')->default(true)->comment('是否上架，0 未上架，1 上架');
            $table->float('rating')->unsigned()->default(5)->comment('商品评分');
            $table->integer('sales')->unsigned()->default(0)->comment('销量');
            $table->integer('stock')->unsigned()->default(0)->comment('总库存');
            $table->tinyInteger('spec_type')->default(0)->comment('规格，0 单规格，1 多规格');
            $table->decimal('price',10,2)->comment('sku最低价格');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
