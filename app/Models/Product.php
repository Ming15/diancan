<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $appends = ['image_url', 'slider_image_urls'];

    public function productSkus()
    {
        return $this->hasMany(ProductSku::class,'product_id', 'id');
    }

    public function skuAttributes()
    {
        return $this->hasMany(ProductSkuAttribute::class,'product_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function getSliderImageUrlsAttribute()
    {
        $slider_image = json_decode($this->slider_image, true);

        $slider_image = collect($slider_image)->transform(function ($value) {
            $value = Storage::disk('public')->url($value);
            return $value;
        });

        return $slider_image;
    }


}
