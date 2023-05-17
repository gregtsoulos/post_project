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

use App\Models\Sub_admins;

class Sub_admin extends Controller
{
    //          Authentication              //

    public function index(){
    	return view('sub_admin/login');
    }

    public function postLogin(Request $request){

        request()->validate([

            'username' => 'required',
            'pass_word' => 'required'

        ]);

        $pass = md5($request->input('pass_word'));

        $admin = Sub_admins::where([

            ["username","=",$request->get('username')],
            ["password","=",$pass]

        ])->first();
        
        if(isset($admin->username)){

            session(['username'=>$request->get('username'),'sub_admin_id'=>$admin->sub_admin_id]);

            return redirect()->intended('sub_admin');

        } else {

            return back()->with('error_password', 'Wrong Login Details');

        }
        

    }


    public function adminLogout(Request $request){

        $request->session()->forget('username');

        return redirect()->intended('/sub_admin/login');

    }

    private function adminSession(){

    
    if(session()->has('data')){

        return redirect('sub_admin/login');

    } else {


    return view('sub_admin/home');

    }

    }

   public function update_order_status(Request $request,$id) {
        $order_status = $request->input('order_status');

        DB::update('update order_form set order_status = ? where inquiry_id = ?',[$order_status,$id]);
        return redirect('sub_admin/single_order/'.$id)->with('success_order_status', 'You have updated the existing status!');
    }

    public function update_payment_status(Request $request,$id) {
        $payment_status = $request->input('payment_status');

        DB::update('update order_form set payment_status = ? where inquiry_id = ?',[$payment_status,$id]);
        return redirect('sub_admin/single_order/'.$id)->with('success_payment_status', 'You have updated the existing status!');
    }

    
}
