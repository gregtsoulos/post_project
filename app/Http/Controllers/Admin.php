<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Validator,Response;
use Auth;
use App\Http\Controllers\Redirect;
use Session;
use Hash;
use DB;

use App\Models\Admins;

class Admin extends Controller
{
    //          Authentication              //

    public function index(){
    	return view('admin/login');
    }

    public function postLogin(Request $request){

        request()->validate([

            'username' => 'required',
            'pass_word' => 'required'

        ]);

        $pass = md5($request->input('pass_word'));

        $admin = Admins::where([

            ["username","=",$request->get('username')],
            ["password","=",$pass]

        ])->first();
        
        if(isset($admin->username)){

            session(['username'=>$request->get('username'),'admin_id'=>$admin->admin_id]);

            return redirect()->intended('admin');

        } else {

            return back()->with('error_password', 'Wrong Login Details');

        }
        

    }


    public function adminLogout(Request $request){

        $request->session()->forget('username');

        return redirect()->intended('/admin/login');

    }

    private function adminSession(){

    
    if(session()->has('data')){

        return redirect('admin/login');

    } else {


    return view('admin/home');

    }

    }

    //          Posts               //

    public function insert_post(Request $request){
        $status = $request->input('status');
        $title = $request->input('title');
        $post_text = $request->input('post_text');
        $publish_date = $request->input('publish_date');
        $photo = $_FILES['photo']['name'];
        $approval = 0;
        $hashtags = $request->input('hashtags');
        $brand = 'Brand Test';
        $post_date = date('Y-m-d');

        $filename = "post_photos/" . $_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"], $filename);

        DB::insert('insert into posts (status,title,post_text,publish_date,approval,hashtags,brand,photo,created_at,updated_at) values(?,?,?,?,?,?,?,?,?,?)',[$status,$title,$post_text,$publish_date,$approval,$hashtags,$brand,$photo,$post_date,$post_date]);
        return redirect('admin/add_post')->with('success_message', 'You have entered the new post!');
    }

    public function update_post(Request $request,$id) {
        $status = $request->input('status');
        $title = $request->input('title');
        $post_text = $request->input('post_text');
        $publish_date = $request->input('publish_date');
        $approval = 0;
        $hashtags = $request->input('hashtags');
        $brand = 'Brand Test';
        $post_date = date('Y-m-d');

        $photo = $_FILES['photo']['name'];

        $filename = "post_photos/" . $_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"], $filename);

        DB::update('update posts set status = ?,title = ?,post_text = ?,publish_date = ?,approval = ?,hashtags = ?,brand = ?,photo = ?, created_at = ?,updated_at = ? where id = ?',[$status,$title,$post_text,$publish_date,$approval,$hashtags,$brand,$photo,$post_date,$post_date,$id]);
        return redirect('admin/edit_post/'.$id)->with('success_message', 'You have updated the existing post!');
    }

    public function delete_post($id) {

    DB::delete('delete from posts where id = ?',[$id]);
     return redirect('admin/post_list');
    }

    

    
}
