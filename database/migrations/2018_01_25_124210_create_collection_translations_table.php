<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('collection_id')->unsigned();

            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('short')->nullable();
            $table->string('locale')->index();

            $table->unique(['collection_id','locale']);
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
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
        Schema::dropIfExists('collection_translations');
    }
}
