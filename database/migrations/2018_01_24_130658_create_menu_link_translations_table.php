<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLinkTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_link_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_link_id')->unsigned();

            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('desc')->nullable();
            $table->string('sufix')->nullable();
            $table->string('locale')->index();

            $table->unique(['menu_link_id','locale']);
            $table->foreign('menu_link_id')->references('id')->on('menu_links')->onDelete('cascade');
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
        Schema::dropIfExists('menu_link_translations');
    }
}
