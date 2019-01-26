<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
                $user = new User();
                $user->name=$data['name'];
                $user->mobile=$data['mobile'];
                $user->email=$data['email'];
                $user->save();
    		// User::create(['name'=>$data['name'], 'mobile'=>$data['mobile'],'email'=>$data['email']]);
    		}catch(\Exception $e){
    			$request->session()->flash('alert-danger', $e->getMessage());
    			return redirect()->back();
    		}
    		$message = 'User Add Successfully';
    		$request->session()->flash('alert-success', $message);
    		return redirect()->back();
    	}else{
    		return redirect()->back();
    	}
    }
}
