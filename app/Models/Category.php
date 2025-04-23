<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'status'
    ];
    
    // Temporarily comment out this relationship until Item model is created
    /*
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    */
}
