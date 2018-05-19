<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiDetailPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_transaksi");
            $table->unsignedInteger("id_part");
            $table->decimal("harga_jual",12,2);
            $table->integer("jumlah");
            $table->integer("total_harga");
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('transaksis');
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
        Schema::dropIfExists('transaksi_detail_parts');
    }
}
