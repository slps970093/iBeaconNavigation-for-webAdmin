<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IBeaconGuidance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibeacon_guidance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mac_address');
            $table->string('UUID');
            $table->string('Major_ID')->nullable();
            $table->string('Minor_ID')->nullable();
            $table->string('link');
            $table->string('title');
            $table->string('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ibeacon_guidance');
    }
}
