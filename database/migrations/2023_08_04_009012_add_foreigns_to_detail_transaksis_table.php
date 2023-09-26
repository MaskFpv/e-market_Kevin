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
        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table
                ->foreign('transaksi_id')
                ->references('id')
                ->on('transaksis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types')
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
        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->dropForeign(['transaksi_id']);
            $table->dropForeign(['transaction_type_id']);
        });
    }
};
