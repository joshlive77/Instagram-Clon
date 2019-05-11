<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    // relacion many yo one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    // relacion many yo one
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
