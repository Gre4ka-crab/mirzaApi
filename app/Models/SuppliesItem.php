<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliesItem extends Model
{
    public $fillable = [
        'supplies_id',
        'product_id',
    ];

    use HasFactory;
}
