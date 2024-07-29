<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function aboutUs(){
        if(true){
            return redirect()->route('article');
        }
        return '<h1>Hello world guys</h1>';
    }
}
