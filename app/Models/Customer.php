<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function orderArchives()
    {
        return $this->hasMany(OrderArchive::class);
    }

    //many-to-many between Customer and NewOrder
    public function newOrders()
    {
        return $this->belongsToMany(NewOrder::class, 'new_order_ordered_product', 'customer_id', 'new_order_id')
            ->withTimestamps();
    }

    //many-to-many between Customer and OrderedProduct
    public function orderedProducts()
    {
        return $this->belongsToMany(OrderedProduct::class, 'new_order_ordered_product', 'customer_id', 'ordered_product_id')
            ->withTimestamps();
    }

    //one-to-one between Customer and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
