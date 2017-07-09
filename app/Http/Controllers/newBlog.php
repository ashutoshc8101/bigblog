<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Blog;

class newBlog extends Controller
{
    public function index(Request $Request, Response $Response){
        $tags = \App\Tag::all();

//        foreach($tags as $tag){
//            var_dump($tag);
//            echo "<hr>";
//        }
//        die();

        return view("newBlog", ["tags" => $tags]);
    }

    public function post(Request $request, Response $response){

        $this->validate($request, [
            'title' => 'required|unique:blogs',
            'cont' => 'required',

        ]);


        $blog = new \App\Blog;

        $blog->slug = str_slug($request->title);
        $blog->title = $request->title;
        $blog->banner = " ";
        $blog->body = $request->cont;
        $blog->description = $request->description;
        $blog->user_id = Auth::id();

        $image = new \App\Image;
        $image->url = $request->banner;
        $image->save();

        $blog->image()->attach($image->id);

        $blog->save();


        if($request->tags[0]){
            foreach($request->tags as $tagk){
                $tg = \App\Tag::get()->where('id', $tagk["customProperties"]["real_id"])->first();

                if($tg === null){
                    $tag = new \App\Tag;
                    $tag->name = $tagk->name;
                    $tag->slug = str_slug($tagk->name);
                    $tag->save();
                    $blog->tags()->attach($tagk->id);
                }else{
                    $blog->tags()->attach($tg->id);
                }
            }

        }

        return response()->json(["status" => "success", "tags"=> $request->tags]);
    }

}
