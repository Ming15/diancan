<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    //  如果传进来模型不再存在，则删除该任务。
    public $deleteWhenMissingModels = true;

    // 任务失败多少次后标记为失败
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->order;
        // 如果订单为待支付
        if ($order->status == Order::UNPAID) {
            DB::beginTransaction();
            try {
                $order->status = Order::CLOSED; // 关闭订单
                $order->update(['status' => Order::CLOSED]);
                foreach ($order->orderItems as $item) {
                    // 订单所购买的库存都加回去对应的商品
                    $item->productSku()->increment('stock', $item->num);
                    $item->product()->increment('stock', $item->num);
                    // 减销量
                    $item->productSku()->decrement('sales', $item->num);
                    $item->product()->decrement('sales', $item->num);
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error($exception->getMessage());
                $this->fail($exception);
            }

        }
    }
}
