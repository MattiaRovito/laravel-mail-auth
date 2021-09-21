<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    //* Many-To-Many
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
