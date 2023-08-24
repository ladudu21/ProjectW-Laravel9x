<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
        'img',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function getImg()
    {
        $url = $this->img;

        if (empty($url)) {
            return '/img/noImg.png';
        }
        return $url;
    }
}
