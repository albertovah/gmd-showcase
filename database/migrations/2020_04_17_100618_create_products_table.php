<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('titel', 100);
            $table->text('omschrijving');
            $table->string('afbeelding', 100)->nullable();
            $table->string('leerlingen', 100)->nullable();
            $table->string('link', 100)->nullable();
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('module_id');
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('categorie_id')->references('id')->on('categories');
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
