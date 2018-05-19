<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiDetailServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_transaksi");
            $table->unsignedInteger("id_service");
            $table->decimal("harga_jual",12,2);
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('transaksis');
            $table->foreign('id_service')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_detail_services');
    }
}
