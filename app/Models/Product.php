<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function sections() {
        return $this->belongsTo(Section::class,'section_id');
    }
    protected $table = 'products';
    
    protected $fillable = [
        'name', 'description', 'price', 'section_id', 'img'
    ];    

    public function shoppingCart() {
        return $this->hasMany(ShoppingCart::class);
    }
}
