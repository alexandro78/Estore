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

    //many to many relationship between Cart and Product
    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'total']);
    }
}
