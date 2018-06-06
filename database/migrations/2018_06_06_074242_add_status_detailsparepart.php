<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusDetailsparepart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('detail_parts', function (Blueprint $table) {
            $table->enum('status', ['terjual','tersedia']);
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
        Schema::table('detail_parts', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
}
