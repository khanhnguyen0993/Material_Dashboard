<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListenerPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listener_prize', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('listener_id');
          $table->unsignedSmallInteger('user_id');
          $table->unsignedInteger('competition_id');
          $table->unsignedInteger('prize_id')->nullable();
          $table->unsignedSmallInteger('status')->nullable();
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
        Schema::dropIfExists('listener_prize');
    }
}
