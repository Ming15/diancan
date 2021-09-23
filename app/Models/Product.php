<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function productSkus()
    {
        return $this->hasMany(ProductSku::class,'product_id', 'id');
    }

    public function skuAttributes()
    {
        return $this->hasMany(ProductSkuAttribute::class,'product_id', 'id');
    }


}
