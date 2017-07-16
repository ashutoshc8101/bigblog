<?php 
namespace App;


class Blog extends \Eloquent {

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function image(){
        return $this->hasOne('App\Image', 'imagable_id');
    }

    public function comments(){
        return $this->morphToMany("App\Comment", "commentable");
    }

}