<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [ 'user_id', 'title', 'description', 'image' ];
}