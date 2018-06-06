<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSparepart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('parts', function (Blueprint $table) {
            $table->dropColumn(['nomor_part']);
        });

        Schema::table('detail_parts', function (Blueprint $table) {
            $table->string('nomor_part');
            $table->dropColumn(['stok']);
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
        Schema::table('parts', function (Blueprint $table) {
            $table->string('nomor_part');

        });

        Schema::table('detail_parts', function (Blueprint $table) {
            $table->integer('stok');
        });
    }
}
