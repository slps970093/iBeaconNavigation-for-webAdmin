<?php

use Illuminate\Database\Seeder;
use App\web_info as WebinfoEloquent;
class WebinfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        WebinfoEloquent::create(['title' => 'iBeacon App 後台導覽管理資訊系統']);
    }
}
