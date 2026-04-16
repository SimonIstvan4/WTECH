<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_item extends Model
{
    protected $table = 'Order_item';

    protected $fillable = [
        'Order_id',
        'Product_variant_id',
        'Quantity'
    ];

    public $timestamps = false;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'Order_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Productvariant::class, 'Product_variant_id');
    }
}