<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNullableFieldsOnListenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('listeners', function (Blueprint $table) {
        $table->string('lastName')->nullable()->change();
        $table->date('DOB')->nullable()->change();
        $table->string('phone')->nullable()->change();
        $table->string('email')->nullable()->change();
        $table->string('suburb')->nullable()->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
