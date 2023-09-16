<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'note',
        'status',
        'delivery_method',
        'payment_method',
        'country',
        'destination_city',
        'street_delivery_point',
        'shipping_address',
        'first_name',
        'last_name',
        'phone_number',
        'company',
        'street_address',
        'postcode',
        'email_address',
        'order_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //?
    public function orderedProducts()
    {
        return $this->hasMany(OrderedProduct::class);
    }
}
