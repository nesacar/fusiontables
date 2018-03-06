<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(0);
            $table->integer('collection_id')->nullable()->default(0);
            $table->integer('parent')->nullable()->default(0);
            $table->integer('level')->nullable()->default(1);
            $table->integer('order')->nullable();
            $table->integer('price_small')->nullable();
            $table->integer('price_outlet')->nullable();
            $table->string('image')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->timestamp('publish_at')->nullable();
            $table->boolean('publish')->nullable();
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
        Schema::dropIfExists('products');
    }
}
