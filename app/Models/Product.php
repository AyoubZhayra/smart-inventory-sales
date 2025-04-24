<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'subcategory_id',
        'ref',
        'price',
        'cost_price',
        'stock_quantity',
        'image_path',
        'status'
    ];
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
