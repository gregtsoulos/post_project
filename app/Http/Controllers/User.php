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

use App\Models\Users;
use App\Models\Payment;
use Razorpay\Api\Api;

class User extends Controller
{
    //          Authentication              //

    public function index(){
        return view('login');
    }

    public function postLogin(Request $request){

        request()->validate([

            'email_address' => 'required',
            'password' => 'required'

        ]);

        $pass = md5($request->input('password'));

        $user = Users::where([

            ["email_address","=",$request->get('email_address')],
            ["password","=",$pass],
            ["registration_status","=",1]

        ])->first();
        
        if(isset($user->email_address)){

            session(['email_address'=>$request->get('email_address'),'user_id'=>$user->user_id]);

            return redirect()->intended('/');

        } else {

            return back()->with('invalid_user_details', 'Wrong Login Details');

        }
        

    }


    public function UserLogout(Request $request){

        $request->session()->forget('user_id');

        return redirect()->intended('/');

    }

}
