<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable =[
        'inventory_category_id',
        'name',
        'quantity',
        'description',
        'sku',
        'price',
        'supplier_id',
        'reorder_level',
    ];
}
