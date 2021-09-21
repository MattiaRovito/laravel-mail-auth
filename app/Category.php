<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        // il $this indica proprio la categoria, in questo caso Category.

        // N.B.: hasMany-> plurale (infatti posts). Ovvero, una categoria può avere molti post.
        return $this->hasMany('App\Post');
    }
};
