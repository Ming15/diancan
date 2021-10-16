<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    public $appends = ['background_url'];


    public function categories()
    {
        return $this->hasMany(ProductCategory::class,'category_id', 'id');
    }

    public function getBackgroundUrlAttribute()
    {
        return Storage::disk('public')->url($this->background);
    }
}
