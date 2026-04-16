<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Ak sa tvoja tabuľka volá 'Category', definuj to tu
    protected $table = 'Category';
    
    // Ak nepoužívaš created_at a updated_at stĺpce
    public $timestamps = false;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'Category_id');
    }
}