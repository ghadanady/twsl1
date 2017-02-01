<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'getLogout']);
    }

    /**
    * render the login page.
    *
    * @return string|view
    */

    public function getIndex()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $r){
        // 1- Validator::make()
        // 2- check if fails
        // 3- fails redirect or success not redirect

        $this->validate($r,[
            'username' => 'required',
            'password' => 'required',
        ],[
            "username.required" => trans('validation.required', ['attribute' => trans('admin_global.users_username') ]),
            "password.required" => trans('validation.required', ['attribute' => trans('admin_global.users_password') ]),
        ]);

        // grapping user credentials
        $username = $r->input('username');
        $password = $r->input('password');

        // Searching for the user matches the passed email or username
        $user= User::where('username' , $username)->orWhere('email' ,$username)->first();

        if( $user && Hash::check($password, $user->password) ){
            // login the user
            Auth::login($user ,$r->has('remember'));
            return redirect()->intended('/admin');
        }
        // failed
        return redirect()->back()->with('error' , trans('admin_global.msg_error_login'));
    }

    /**
    * Logout The user
    */
    public function getLogout()
    {
        Auth::logout();

        return redirect('/admin/auth')->with('info',trans('admin_global.msg_success_logout'));
    }

    ////////////////////////////////////////////////////////////////////////////////

    public function getRecoverPassword(){
        return view('admin.auth.recover-password');
    }

    public function postRecoverPassword(Request $r){

        $this->validate($r,[
            'email' => 'required|email',
        ],[
            "email.email" => trans('validation.email', ['attribute' => trans('admin_global.users_email') ]),
            "email.required" => trans('validation.required', ['attribute' => trans('admin_global.users_email') ]),
        ]);

        // grapping user credentials
        $email = $r->input('email');

        $user= User::where('email' ,$email)->first();

        if( $user ){
            $recover_hash = str_random(128);

            $user->update(compact('recover_hash'));

            Mail::send('admin.mails.recover-password',
            compact('user','recover_hash'),
            function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Recover Password!');
            });

            return redirect('admin/auth/login')->withSuccess(trans('admin_global.msg_recover_password'));
        }
        // failed
        return redirect()->back()->with('error' , trans('admin_global.msg_error_login'));
        // dd($r->all());
    }

    public function getChangePassword($hash){

        $user= User::where('recover_hash' ,$hash)->first();

        if( $user ){
            return view('admin.auth.new-password' , compact('hash'));
        }

        // failed
        return redirect('admin/auth/login')->with('error' , trans('admin_global.msg_error_login'));
    }

    public function postChangePassword(Request $r){

        // Searching for the user matches the recover_hash
        $user= User::where('recover_hash' ,$r->input('_hash'))->first();

        if( $user ){

            $this->validate($r,[
                'password' => 'required|password',
                'repassword' => 'required|same:password',
            ],[
                "password.required" => trans('validation.required', ['attribute' => trans('admin_global.users_password') ]),
                "repassword.same" => trans('admin_global.validation_repassword'),
            ]);

            // grapping user credentials
            $password = bcrypt($r->input('password'));
            $recover_hash = null;

            $user->update(compact('password','recover_hash'));

            return redirect('admin/auth/login')->with('success' , trans('admin_global.msg_change_password'));

        }
        // failed
        return redirect()->back()->with('error' , trans('admin_global.msg_error_login'));
    }

}
