<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\iBeaconguidanceCreate as iBeaconCreate;
use App\Http\Requests\iBeaconguidanceUpdate as iBeaconUpdate;
use App\iBeacon_guidance as iBeaconEloquent;
use App\web_info as WebinfoEloquent;
use View;
class iBeacon_guidance extends Controller
{
    public function index(){
        $web_data = WebinfoEloquent::find(1);
        $result = iBeaconEloquent::paginate(8);
        //https://www.codecasts.com/blog/post/programming-with-laravel-5-blade-views-with-var
        return view('iBeacon_admin/index',['result' => $result,'title' => $web_data->title]);
    }
    public function create(iBeaconCreate $request){
        $result = iBeaconEloquent::create(array(
            'name' => htmlspecialchars($request->name),
            'mac_address' => htmlspecialchars($request->mac_address),
            'title' => htmlspecialchars($request->title),
            'content' => htmlspecialchars($request->content),
            'link' => htmlspecialchars($request->link)
        ));
        if($result){
            http_response_code(201);
            return response()->json(['status' => true]);
        }else{
            http_response_code(400);
            return response()->json(['status' => false]);
        }
    }
    public function update(iBeaconUpdate $request,$id){
        if(is_numeric($id)){
            $result = iBeaconEloquent::find($id);
            $result->name = htmlspecialchars($request->name);
            $result->mac_address = htmlspecialchars($request->mac_address);
            $result->title = htmlspecialchars($request->title);
            $result->content = htmlspecialchars($request->content);
            $result->link = htmlspecialchars($request->link);
            $result->save();
            if($result){
                http_response_code(201);
                return response()->json(['status' => true]);
            }else{
                http_response_code(400);
                return response()->json(['status' => false]);
            }
        }else{
            http_response_code(400);
            return response()->json(['status' => false]);
        }
    }
    public function ajax_getData($id){
        if(is_numeric($id) && !is_null($id)){
            $result = iBeaconEloquent::find($id);
            $data[0] = array(
                'id' => $result->id,
                'name' => $result->name,
                'mac_address' => $result->mac_address,
                'link' => $result->link,
                'title' => $result->title,
                'content' => $result->content
            );
            return response()->json($data,200);
        }
    }
    public function delete(Request $request,$id){
        $validator= Validator::make($request->all(),['id' => 'required|integer'], ['integer'=> 'is integer','required' => 'required']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $result = iBeaconEloquent::find($request->id);
            $result->delete();
            http_response_code(201);
            return response()->json(['status' => true]);
        }
        http_response_code(400);
        return response()->json(['status' => false]);
    }
    public function api_getData(){
        $result = iBeaconEloquent::all();
        $data = [];
        $tmp = 0;
        foreach ($result as $row){
            $data[$tmp]['name'] = $row->name;
            $data[$tmp]['mac_address'] = $row->mac_address;
            $data[$tmp]['link'] = $row->link;
            $data[$tmp]['title'] = $row->title;
            $data[$tmp]['content'] = $row->content;
            $tmp++;
        }
        http_response_code(200);
        return response()->json($data);
    }
}