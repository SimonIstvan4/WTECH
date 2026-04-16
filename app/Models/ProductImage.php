<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'Product_image';
    protected $fillable = ['Product_id', 'Image_path', 'Main'];
    public $timestamps = false;
}