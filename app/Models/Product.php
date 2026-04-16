<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'Product';
    public $timestamps = false;

    protected $fillable = ['Name', 'Price', 'Description', 'Category_id', 'Brand_id', 'Season'];

    // Produkt patrí jednej značke
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'Brand_id', 'id');
    }

    // DOPLNENÉ: Produkt patrí do jednej kategórie
    public function category(): BelongsTo
    {
        // Skontroluj, či sa stĺpec v databáze volá 'Category_id' (častý štandard)
        return $this->belongsTo(Category::class, 'Category_id', 'id');
    }

    // Produkt má viac obrázkov
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'Product_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'Product_id');
    }
}