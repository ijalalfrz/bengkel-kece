<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyesuaianStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyesuaian_stoks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_part');
            $table->enum('jenis',['tambah','kurang']);
            $table->string('deskripsi');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('id_part')->references('id')->on('parts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyesuaian_stoks');
    }
}
