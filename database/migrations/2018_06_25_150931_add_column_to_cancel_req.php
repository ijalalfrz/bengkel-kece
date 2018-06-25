<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCancelReq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('transaksi_cancel_requests', function (Blueprint $table) {
            $table->enum('status',['disetujui','ditolak'])->nullable();

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
         Schema::table('transaksi_cancel_requests', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
