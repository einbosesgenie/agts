<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;


class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Product::class, 'related_products');
    }
}
