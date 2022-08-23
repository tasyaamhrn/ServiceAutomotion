<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloks', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->uuid('id_perumahan');
            $table->string('name');
            $table->string('denah');
            $table->timestamps();
            $table->foreign('id_perumahan')
            ->references('id')->on('perumahans')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bloks');
    }
}
