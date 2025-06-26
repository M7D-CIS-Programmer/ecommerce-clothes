<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    protected $table = 'check_outs';

    protected $fillable = ['country','address','phone','cartId','userId'];
}
