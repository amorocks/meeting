<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id')->unsigned();
            $table->integer('agenda_listing_id')->unsigned();
            $table->string('agenda_listing_type');
            $table->string('added_by');
            $table->integer('duration')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->timestamps();

            // $table->foreign('added_by')
            //         ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda_listings');
    }
}
