<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use DB;
use File;

class UserController extends Controller
{
    //

    public function CreateUserdata(Request $request){
    	$data = $request->all();

        // echo "<pre>";
        // print_r($data);
        // die;

        $imagename='';
        if ($request->hasFile('image')) 
        {
            $file=$request->file('image');
            $fileName=$file->getClientOriginalName();
            $extension=$file->getClientOriginalExtension();
            if ($extension=='jpg' || $extension=='JPG' || $extension=='png' || $extension=='PNG' || $extension=='jpeg')
            {
                $imgname=uniqid().$fileName;
                $destinationPath=public_path('/img/');
                $file->move($destinationPath,$imgname);
            }
            else{
                $request->session()->flash('alert-danger', 'File type not valid!');
                return redirect()->back();

            }
        }
        // else{
        //     $imagename='';
        // }

    	// $data = $request->input();
    	
    	if (!empty($data)) {
    		try{
                // DB::table('users')->insert([
                //                         'name'=>$data['name'],
                //                         'mobile'=>$data['mobile'],
                //                         'email'=>$data['email'],
                //                         'image'=>$imgname
                //                     ]);

                //Using Model
                $user = new User();
                $user->name=$data['name'];
                $user->mobile=$data['mobile'];
                $user->email=$data['email'];
                $user->image=$imgname;
                $user->save();
                foreach ($data['book'] as $key => $value) {
                    $book=new Book();
                    $book->book=$value;
                    $book->user_id=$user->id;
                    $book->save();
                }




    		// User::create(['name'=>$data['name'], 'mobile'=>$data['mobile'],'email'=>$data['email']]);
    		}catch(\Exception $e){
    			$request->session()->flash('alert-danger', 'Field Must not be empty!');
                // $e->getMessage()
    			return redirect()->back();
    		}
    		$message = 'User Add Successfully';
    		$request->session()->flash('alert-success', $message);
    		return redirect()->back();
    	}else{
    		return redirect()->back();
    	}
    }

    public function ReadData(){
        $books=Book::with('user')->get()->toArray();

        $users = User::with('Books')->get()->toArray();
        // $users = DB::table('users')->get();
        $users= json_decode(json_encode($users),true);
        // For testing purpose
        // echo "<pre>";
        // print_r($books);
        // die;

        return view('welcome', ['users'=>$users]);    
        
        // $name = "Welcome to my ZamanWebDeveloper Website.";
        // return view('welcome')->with('name', $name);
        // return view('welcome')->with(compact('name'));
        // return view('welcome', compact('name'));

    }
    public function edit_users($id){

        $id = convert_uudecode(base64_decode($id));
        $userdata = User::with('Books')->where('id', $id)->first()->toArray();
        $userdata= json_decode(json_encode($userdata),true);
        return view('editusers',['userdata'=>$userdata]);


        // echo $id;die();
        // $userdata = DB::table('users')->where('id', $id)->first();


        // $userdata = User::where('id', $id)->first()->toArray();
    }

    public function updateusers(Request $request){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $oldImage=User::where('id',$data['user_id'])->value('image');
            $fullPath=public_path('/img/').$oldImage;
            File::delete($fullPath);

            $file=$request->file('image');
            $fileName=$file->getClientOriginalName();
            $extension=$file->getClientOriginalExtension();
            $imgname=uniqid().$fileName;
            $destinationPath=public_path('/img/');
            $file->move($destinationPath,$imgname);
        }else{
            $imgname=User::where('id',$data['user_id'])->value('image');

        }

    //     echo "<pre>";
    //     print_r($data);
    //     die;
    
        try {
        // DB::table('users')->where('id',$data['user_id'])->update([
        //     'name'=>$data['name'],
        //     'mobile'=>$data['mobile'],
        //     'email'=>$data['email']
        // ]);
        //Using Model

        User::where('id',$data['user_id'])->update([
                                    'name'=>$data['name'],
                                    'mobile'=>$data['mobile'],
                                    'email'=>$data['email'],
                                    'image'=>$imgname
                                    ]);
        Book::where('user_id',$data['user_id'])->update(['book'=>$data['book']]);

        $request->session()->flash('alert-success', 'User Update Successfully');

        } catch (\Exception $e) {
        $request->session()->flash('alert-danger', 'Failed');
        }
        return redirect()->to('/');
    }
    public function deleteusers(Request $request,$id){
        $id = convert_uudecode(base64_decode($id));
        try {
            DB::table('users')->where('id',$id)->delete();
        $request->session()->flash('alert-success', 'User Delete Successfully');
            
        } catch (\Exception $e) {
        $request->session()->flash('alert-danger', 'Failed');
        }
        return redirect()->back();
    }
    public function Invest(){
        return view('invest');
    }
}
