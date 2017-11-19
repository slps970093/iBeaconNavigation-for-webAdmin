<?php

namespace iBeaconProject\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use iBeaconProject\web_info as WebinfoEloquent;

class WebinfoController extends Controller
{
    public function getWebinfo(){
        $result = WebinfoEloquent::find(1);
        $data = array(
            'title' => $result->title
        );
        return response()->json($data,200);
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), ['title' => 'required'], ['required' => 'required']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $result = WebinfoEloquent::find(1);
            $result->title = htmlspecialchars($request->title);
            $result->save();
            if($result){
                return response()->json(['status' => true],201);
            }else{
                return response()->json(['status' => false],400);
            }
        }
        return response()->json(['status' => false],400);
    }
}
