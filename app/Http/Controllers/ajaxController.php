<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxController extends Controller
{
    public function user(Request $request){
        $tag = \App\Tag::get()->where('slug', $request->tag)->first();
        if($tag){
            return response()->json(['data' => $tag->users->toArray()]);
        }

       return response(["status" => 'tag not found'], 404);

    }

    public function blog(Request $request){
        $tag = \App\Tag::get()->where('slug', $request->tag)->first();
        if($tag){
            return response()->json(['data' => $tag->blogs->toArray()]);
        }

        return response(["status" => 'tag not found'], 404);

    }
}
