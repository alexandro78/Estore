<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    
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

    public function newOrders()
    {
        return $this->hasMany(NewOrder::class);
    }

    public function orderArchives()
    {
        return $this->hasMany(OrderArchive::class);
    }
}
