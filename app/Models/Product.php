<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // добавляем имя в список fillable свойств
        'article',
        'description',
        'color',
        'in_stock',
        'price',
        'brand',
        'country',
        'date_add',
        'date_update',
        'quantity',
        'category_id',
        'size_id',
        'discount_id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function freeShipping()
    {
        return $this->belongsTo(FreeShipping::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}
