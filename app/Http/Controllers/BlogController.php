<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Blog;

class BlogController extends Controller{

    public function blog(Request $Request, Response $Response, $slug){
        $blog = Blog::where('slug', $slug)->first();
        if($blog == null){
            return "404 Not found";
        }

        return view('blog', ['blog' => $blog]);

    }

    public function comments(Request $request, Response $response, $slug){

        $blog = Blog::where('slug', $slug)->first();

        $comments = $blog->comments;

        foreach($comments as $comment){
            $comment["user"] = $comment->user;
        }

        return response()->json($comments);

    }


}