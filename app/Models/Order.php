<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } 

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
