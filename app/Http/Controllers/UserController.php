<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
    	$name = "Welcome to my ZamanWebDeveloper Website.";
    	// return view('welcome')->with('name', $name);
    	// return view('welcome')->with(compact('name'));
    	// return view('welcome', compact('name'));
    	return view('welcome', ['name'=>$name]);
    }
}
