<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedMediumInteger('competition_id');
            $table->unsignedSmallInteger('user_id');
            $table->date('date');
            $table->string('update');
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
        Schema::dropIfExists('competition_histories');
    }
}
