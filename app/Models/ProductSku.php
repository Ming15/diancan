<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductSku extends Model
{
    use HasFactory;

    protected $table = 'product_skus';

    protected $appends = ['image_url'];

    protected $fillable = [
        'product_id',
        'title',
        'sales',
        'stock',
        'price',
        'ot_price',
        'image',
        'attributes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }


    public function getImageUrlAttribute()
    {
        $value = '';
        if ($this->image) {
            $value = Storage::disk('public')->url($this->image);
        }
        return $value;
    }
}
