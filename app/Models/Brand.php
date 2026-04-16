<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'Brand';
    public $timestamps = false;

    public function products() {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
