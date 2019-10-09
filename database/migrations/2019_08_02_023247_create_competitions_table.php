<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('competitions', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->unsignedSmallInteger('station');
        $table->unsignedSmallInteger('type');
        $table->mediumText('description')->nullable();
        $table->boolean('status');
        $table->unsignedInteger('user_id');
        $table->date('startDate'); // datetime
        $table->date('endDate');   // datetime
        $table->timestamps();
        $table->boolean('drawn')->default(false);
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('competitions');
    }
  }
