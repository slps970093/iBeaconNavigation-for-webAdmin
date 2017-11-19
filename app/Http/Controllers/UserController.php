<?php

namespace iBeaconProject\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use iBeaconProject\User as UserEloquent;
use iBeaconProject\web_info as WebinfoEloquent;
use Illuminate\Http\Request;
use iBeaconProject\Http\Requests\UserCreate as UserCreate;
use iBeaconProject\Http\Requests\UserUpdate as UserUpdate;


class UserController extends Controller{

    
    public function index(){
        $web_data = WebinfoEloquent::find(1);
        $result = UserEloquent::paginate(8);
        return view('User/index',['result' => $result,'title' => $web_data->title]);
    }   
    public function ajax_get_data($id){
        if(is_numeric($id)){
            $result = UserEloquent::find($id);
            $data = array(
                'id' => $result->id,
                'username' => $result->username,
                'name' => $result->name,
                'email' => $result->email
            );
            return response()->json($data,200);
        }
        return response()->json(array('status' => false),400);
    }
    public function create(UserCreate $request){
        $result = UserEloquent::create(array(
            'username' => htmlspecialchars($request->username),
            'password' => Hash::make($request->password),
            'name' => htmlspecialchars($request->name),
            'email' => htmlspecialchars($request->email)
        ));
        if($result){
            return response()->json(array('status' => true),201);
        }else{
            return response()->json(array('status' => false),400);
        }
        
    }
    public function update(UserUpdate $request,$id){
        if(is_numeric($id)){
            $result = UserEloquent::find($id);
            $result->username = htmlspecialchars($request->username);
            $result->name = htmlspecialchars($request->name);
            $result->email = htmlspecialchars($request->email);
            $result->save();
            if($result){
                return response()->json(['status' => true],201);
            }else{
                return response()->json(['status' => false],400);
            }
        }
        return response()->json(['status' => false],400);
    }
    public function reset_password(Request $request,$id){
        if(is_numeric($id)){
            $validator = Validator::make($request->all(),['id' => 'required|integer','password' => 'required'],  ['integer'=> 'is integer','required' => 'required']);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }else{
                $result = UserEloquent::find($id);
                $result->password = Hash::make($request->password);
                $result->save();
                if($result){
                    return response()->json(['status' => true],201);
                }else{
                    return response()->json(['status' => false],401);
                }
            }
        }
        http_response_code(400);
        return response()->json(['status' => false]);
    }
    public function delete($id){
        if(is_numeric($id)){
            if($id != 1){
                $result = UserEloquent::find($id);
                $result->delete();
                if($result){
                    return response()->json(['status' => true],201);
                }else{
                    return response()->json(['status' => false],400);
                }  
            }else{
                return response()->json(['status' => false],400);
            }
        }
        return response()->json(['status' => false],400);
    }

}
