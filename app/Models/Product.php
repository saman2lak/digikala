<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function presentPrice($price)
    {
        return number_format($price);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

}
