<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_tikets', function (Blueprint $table) {
            $table->uuid('uuidTiket')->primary();
            // $table->id();
            $table->char('tiket', 20);
            $table->foreign('tiket')->references('noTiket')->on('tikets')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('status', ['Terkirim', 'Diterima', 'Ditolak', 'Dikerjakan', 'Ditutup', 'selesai']);
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
        Schema::dropIfExists('detail_tikets');
    }
};
