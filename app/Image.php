<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    // relacion one yo many
    // saca todos los comentarios
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }
    // relacion one yo many
    public function likes(){
        return $this->hasMany('App\Like');
    }
    // relacion many yo one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
