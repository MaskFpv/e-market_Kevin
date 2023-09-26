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
        Schema::create('tampung_bayars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('total');
            $table->unsignedBigInteger('penjualan_id');
            $table->double('terima');
            $table->double('kembali');

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
        Schema::dropIfExists('tampung_bayars');
    }
};
