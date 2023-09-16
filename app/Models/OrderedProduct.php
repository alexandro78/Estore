<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'article',
        'product_name',
        'product_description',
        'product_size',
        'product_color',
        'brand',
        'country',
        'discount',
        'quantity',
        'price',
        'total',
    ];

    //many-to-many between OrderedProduct and NewOrder
    public function newOrders()
    {
        return $this->belongsToMany(NewOrder::class);
    }

    //many-to-many between OrderedProduct and Customer
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'new_order_ordered_product', 'ordered_product_id', 'customer_id')
            ->withTimestamps();
    }
}
