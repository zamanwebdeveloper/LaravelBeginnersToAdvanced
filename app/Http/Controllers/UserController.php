<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::get()->toArray();
        
        // echo "<pre>";
        // print_r($users);
        // die;

        // $name = "Welcome to my ZamanWebDeveloper Website.";
    	// return view('welcome')->with('name', $name);
    	// return view('welcome')->with(compact('name'));
    	// return view('welcome', compact('name'));

    	return view('welcome', ['users'=>$users]);
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
    public function edit_users($id){
        $id = convert_uudecode(base64_decode($id));
        // echo $id;die();
        $userdata = User::where('id', $id)->first()->toArray();
        return view('editusers',['userdata'=>$userdata]);
    }

    public function updateusers(Request $request){
        $data = $request->all();
    //     echo "<pre>";
    //     print_r($data);
    //     die;
    
        try {
        User::where('id',$data['user_id'])->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']]);
        $request->session()->flash('alert-success', 'User Update Successfully');

        } catch (\Exception $e) {
        $request->session()->flash('alert-danger', 'Failed');
        }
        return redirect()->to('/');
    }
    public function deleteusers(Request $request,$id){
        $id = convert_uudecode(base64_decode($id));
        try {
            User::where('id',$id)->delete();
        $request->session()->flash('alert-success', 'User Delete Successfully');
            
        } catch (\Exception $e) {
        $request->session()->flash('alert-danger', 'Failed');
        }
        return redirect()->back();
    }
}
