<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'Product_variant';
    public $timestamps = false;

    protected $fillable = ['Product_id', 'Size', 'Quantity'];

    public function product() {
        return $this->belongsTo(Product::class, 'Product_id');
    }
}