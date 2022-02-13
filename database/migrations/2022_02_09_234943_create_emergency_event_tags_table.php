<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyEventTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_event_tags', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('emergency_event_ee_id')->unsigned();
            $table->BigInteger('tag_id')->unsigned();
            $table->foreign('emergency_event_ee_id')->references('ee_id')->on('emergency_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency_event_tags');
    }
}
