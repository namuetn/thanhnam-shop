<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'product_name_en',
        'product_name_vi',
        'product_slug_en',
        'product_slug_vi',
        'product_code',
        'product_quanlity',
        'product_tags_en',
        'product_tags_vi',
        'product_size_en',
        'product_size_vi',
        'product_color_en',
        'product_color_vi',
        'selling_price',
        'discount_price',
        'short_description_en',
        'short_description_vi',
        'long_description_en',
        'long_description_vi',
        'product_thumnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status',
    ];
}
