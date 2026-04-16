<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'Order';

    //stĺpce, do ktorých povoľujeme hromadný zápis
    protected $fillable = [
        'User_id',
        'Paid',
        'Session_id'
    ];

    public $timestamps = false;

    public function items(): HasMany
    {
        return $this->hasMany(Order_item::class, 'Order_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id');
    }
}