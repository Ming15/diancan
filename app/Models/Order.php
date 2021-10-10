<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'shop_id',
        'order_no',
        'total_price',
        'remark',
        'status',
        'order_type',
        'take_time',
        'desk_num',
        'order_info',
    ];

    const DELIVERY_TO_TABLE = 0; // 送餐到桌
    const PACK_AND_TAKE_AWAY = 1; // 打包外带

    const UNPAID = 0; // 待支付
    const FINISHED = 1; // 已完成（已支付）
    const CANCELLED = 2; // 已取消
    const REFUND = 3; // 退款售后
    const CLOSED = 4; // 已关闭

    public static $order_type = [
        self::DELIVERY_TO_TABLE => '送餐到桌',
        self::PACK_AND_TAKE_AWAY => '打包外带',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id', 'id');
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('order_no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }
}
