<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class); // 'color_product' - им'я pivot таблиці можна передати другим аргументом якщо им'я pivot таблиці не збігається з дефолтним
    }
}
