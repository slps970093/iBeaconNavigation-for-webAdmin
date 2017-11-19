<?php

namespace iBeaconProject\Http\Controllers;

use Illuminate\Http\Request;
use iBeaconProject\Http\Requests\LoginRequest  as LoginRequest;
use iBeaconProject\web_info as WebinfoEloquent;
use iBeaconProject\User as UserEloquent;
use Auth;
use Redirect;
class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest',['except' => ['logout']]);
    }
   
    public function auth(LoginRequest $request){
        
        $authData = $request->only(['username','password']);
        if(Auth::attempt($authData,$request->has('rememeber'))){
            return redirect()->action('UserController@index');
        }else{
            return redirect('login?failed');
        }
    }
    public function login(){
        $web_data = WebinfoEloquent::find(1);
        return view('login/login',['title' => $web_data->title]);
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('login?logout');
    }
}
