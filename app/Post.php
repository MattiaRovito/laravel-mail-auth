<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        // aggiungo la category_id
        'category_id'
    ];

    public function category(){
        // il $this indica proprio la categoria, in questo caso Posts.

        // N.B.: belongsTo-> singolare (infatti category). Ovvero, un determinato post è scritto da un solo utente.
        return $this->belongsTo('App\Category','category_id', 'id');
    }


    //* Many-To-Many

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
