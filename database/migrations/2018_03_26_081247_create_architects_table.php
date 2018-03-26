<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('email');
            $table->string('url')->nullable();
            $table->string('company')->nullable();
            $table->boolean('publish')->default(1);
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
        Schema::dropIfExists('architects');
    }
}
