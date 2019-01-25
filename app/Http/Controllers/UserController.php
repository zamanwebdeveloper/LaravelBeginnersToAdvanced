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
    public function userdata(Request $request){
    	$data = $request->all();
    	// $data = $request->input();
    	// echo "<pre>";
    	// print_r($data);
    	// die;
    	if (!empty($data)) {
    		try{
    		$id = \DB::table('users')->insertGetId(['name'=>$data['name'], 'mobile'=>$data['mobile'],'email'=>$data['email']]);
    		}catch(\Exception $e){
    			$request->session()->flash('alert-danger', 'Registration Failed');
    			return redirect()->back();
    		}
    		$message = $id.' '. 'User Add Successfully';
    		$request->session()->flash('alert-success', $message);
    		return redirect()->back();
    	}else{
    		return redirect()->back();
    	}
    }
}
