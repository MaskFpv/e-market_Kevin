<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tampung_bayars', function (Blueprint $table) {
            $table
                ->foreign('penjualan_id')
                ->references('id')
                ->on('penjualans')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tampung_bayars', function (Blueprint $table) {
            $table->dropForeign(['penjualan_id']);
        });
    }
};
