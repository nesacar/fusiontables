<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('fullname')->nullable();
            $table->string('locale')->nullable();
            $table->integer('order')->nullable()->default(0);
            $table->boolean('primary')->nullable()->default(0);
            $table->boolean('publish')->nullable();
        });

        \DB::table('languages')->insert([
            'name' => 'english',
            'fullname' => 'english language',
            'locale' => 'en',
            'primary' => true,
            'publish' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
