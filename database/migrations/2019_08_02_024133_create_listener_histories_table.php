<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListenerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('listener_histories', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedMediumInteger('listener_id');
        $table->unsignedSmallInteger('admin_id');
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
      Schema::dropIfExists('listener_histories');
    }
  }
