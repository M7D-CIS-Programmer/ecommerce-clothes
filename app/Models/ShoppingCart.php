<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';
    protected $fillable = ['size','color','quantity','product_id','total'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
