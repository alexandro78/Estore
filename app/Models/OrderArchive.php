<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_size',
        'product_color',
        'quantity',
        'price',
        'total',
        'order_id',
        'customer_id',
        'order_date',
        'note',
        'status',
        'delivery_method',
        'payment_method',
        'destination_city',
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
