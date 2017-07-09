<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    public function imagable(){
        return $this->belongsTo("App\Blog");
    }

}