<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class profileController extends Controller
{


    public function index(Request $request, Response $response, $id){
        $user = \App\User::findOrFail($id);
        return view('Profile', ['user' => $user]);
    }

}
