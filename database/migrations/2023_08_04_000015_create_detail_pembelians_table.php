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
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('pembelian_id');
            $table->double('harga_beli');
            $table->integer('jumlah');
            $table->double('sub_total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelians');
    }
};
