<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iBeacon_guidance extends Model
{
    //
    protected $table="ibeacon_guidance";
    protected $fillable=[
        'name','mac_address','link','title','content'
    ];
}
