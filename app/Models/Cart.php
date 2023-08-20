<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'total',
        'customer_id',
        'product_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    //many to many relationship between Cart and Product
    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class);
    }
    
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
