<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahTabelPembelianPart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pembelian_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("id_part");
            $table->decimal("harga",12,2);
            $table->string('satuan')->nullable();
            $table->integer("jumlah");
            $table->string("supplier");
            $table->decimal("total_harga",12,2);
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
        //
        Schema::dropIfExists('pembelian_parts');

    }
}
