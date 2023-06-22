<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'status',
        'product_id',
        'total_order',
    ];

    public static array $statuses = [
      'sales',
      'refund'
    ];

    use HasFactory;
}
