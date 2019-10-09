<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListenersTable extends Migration
{
    // protected $casts = [
    //   'DOB' => 'dd//mm//yyyy'
    // ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listeners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('lastName')->nullable();
            $table->date('DOB')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('suburb')->nullable();
            $table->unsignedInteger('participations')->default(0);
            $table->string('additionalInfo')->nullable();
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('listeners');
    }
}
