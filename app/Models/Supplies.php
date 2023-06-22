<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Supplies extends Model
{

    /**
     * Get all of the Supply's items.
     */
    public function supplyItems(): HasMany
    {
        return $this->hasMany(SuppliesItem::class);
    }

    public $fillable = [
        'provider_id',
        'supplies_item_id',
        'total_price',
    ];

    use HasFactory;
}
