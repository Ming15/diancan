<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    protected $fillable = [
        'product_id',
        'product_sku_id',
        'num',
        'price'
    ];

    const NO_REFUND = 0;
    const REFUND_SUCCESSFUL = 1;
    const REFUNDING = 2;
    const REFUND_REQUESTED = 3;
    const REFUND_FAILED = 4;

    public static $refundStatus = [
        self::NO_REFUND => '未退款',
        self::REFUND_SUCCESSFUL => '退款成功',
        self::REFUNDING => '退款中', //【退款中】出现在调用了银行或微信退款接口到时接口还没返回值的时候，就会是退款中
        self::REFUND_REQUESTED => '已申请退款', //【已申请退款】出现在用户申请了退款，但是此退款还没有被审核的时候，orderitem表的订单状态就是已申请退款
        self::REFUND_FAILED => '退款失败',
    ];



    public function order()
    {
        return $this->belongsTo(Order::class,'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class,'product_sku_id', 'id');
    }
}
