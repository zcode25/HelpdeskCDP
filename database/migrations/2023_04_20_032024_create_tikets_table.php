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
        Schema::create('tikets', function (Blueprint $table) {
            $table->uuid('idTiket')->primary();
            $table->char('noTiket', 20);
            $table->char('user', 9);
            $table->foreign('user')->references('nik')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->char('teknisi', 9)->nullable();
            $table->foreign('teknisi')->references('nik')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->string('permintaan');
            $table->string('uraianPermintaan');
            $table->timestamp('ekspetasiSelesai')->nullable();
            $table->enum('prioritas', ['A', 'B', 'C'])->nullable();
            $table->enum('status', ['Dikirim', 'Diterima', 'Ditahan', 'Ditolak', 'Komplain Diterima', 'Komplain Ditahan', 'Komplain Ditolak', 'Penugasan Komplain', 'Penugasan', 'Dikerjakan', 'Validasi', 'Komplain', 'Selesai']);
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
        Schema::dropIfExists('tikets');
    }
};
