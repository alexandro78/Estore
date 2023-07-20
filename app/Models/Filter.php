<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // добавляем имя в список fillable свойств
        'min_price',
        'max_price',
        'color_filter',
        'size_filter'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
