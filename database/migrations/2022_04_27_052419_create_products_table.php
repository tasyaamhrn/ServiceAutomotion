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
            $table->uuid('id', 36)->primary();
            $table->uuid('blok');
            $table->integer('no_kavling')->unsigned();
            $table->integer('type');
            $table->integer('luas_tanah')->unsigned();
            $table->integer('price');
            $table->integer('status');
            $table->string('dinding');
            $table->string('pondasi');
            $table->string('lantai');
            $table->string('rangka_atap');
            $table->string('penutup_atap');
            $table->string('daun_pintu');
            $table->string('plafon');
            $table->string('kusen');
            $table->string('kamar_mandi');
            $table->string('sumber_air');
            $table->string('listrik');
            $table->integer('tanah_lebih')->unsigned()->nullable();
            $table->integer('discount')->unsigned()->nullable();
            $table->foreign('blok')
            ->references('id')->on('bloks')
            ->onDelete('cascade');
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
