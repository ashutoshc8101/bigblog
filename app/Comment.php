<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{

    public function blogs(){
        return $this->morphedByMany("App\Blog", "commentable");
    }

    public function user(){
        return $this->belongsTo("App\User");
    }


}