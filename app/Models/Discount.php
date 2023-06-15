<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // добавляем имя в список fillable свойств
        'start_date',
        'end_date',
        'description',
        'price_off',
        'min_amount',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
