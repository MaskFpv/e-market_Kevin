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
        Schema::table('detail_pembelians', function (Blueprint $table) {
            $table
                ->foreign('barang_id')
                ->references('id')
                ->on('barangs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('pembelian_id')
                ->references('id')
                ->on('pembelians')
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
        Schema::table('detail_pembelians', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->dropForeign(['pembelian_id']);
        });
    }
};
