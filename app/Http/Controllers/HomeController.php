<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Blog;
use Illuminate\Support\Facades\App;

class homeController extends Controller{


    public function index(Request $Request, Response $Response){
        $blogPosts = Blog::all();

        return view('home' , ['blogs' => $blogPosts]);
    }


}