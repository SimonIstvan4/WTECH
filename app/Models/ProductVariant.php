<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'Product_variant';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_id');
    }
}