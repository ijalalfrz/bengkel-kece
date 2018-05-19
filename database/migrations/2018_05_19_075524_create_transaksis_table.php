<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_pelanggan")->nullable();
            $table->unsignedInteger("id_montir")->nullable();
            $table->integer("total_harga");
            $table->enum("jenis",["service","beli"]);
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggans');
            $table->foreign('id_montir')->references('id')->on('montirs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
