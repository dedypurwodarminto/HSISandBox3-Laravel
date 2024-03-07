<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $pages = array(
            'title' => 'Home Page'
        );

        // return view('index', $pages);
        return view('home', $pages);
    }
}
