<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomBaruPembelianPart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pembelian_parts', function (Blueprint $table) {
            $table->integer('stok_awal');
            $table->unsignedInteger('stok_akhir');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('pembelian_parts', function (Blueprint $table) {
            $table->dropColumn(['stok_awal']);
            $table->dropColumn(['stok_akhir']);


        });
    }
}
