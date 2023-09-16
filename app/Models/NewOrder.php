<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewOrder extends Model
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

    //many-to-many between NewOrder and OrderedProduct
    public function orderedProducts()
    {
        return $this->belongsToMany(OrderedProduct::class);
    }

    //many-to-many between NewOrder and Customer
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'new_order_ordered_product', 'new_order_id', 'customer_id')
            ->withTimestamps();
    }
}
