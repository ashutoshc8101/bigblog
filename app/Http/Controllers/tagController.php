<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class tagController extends Controller
{

    public function index(Request $request, Response $response, $tagSlug){
        $tag = \App\Tag::get()->where('slug', $tagSlug)->first();

        return view('tagView', ['tag' => $tag]);
    }
}
