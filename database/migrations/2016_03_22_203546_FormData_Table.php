<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormDataTable extends Migration
{
    public function up()
    {
        Schema::create('FormData', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->mediumText('data');
        });
    }

    public function down()
    {
        Schema::drop('FormData');
    }
}
