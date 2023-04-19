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
        Schema::create('users', function (Blueprint $table) {
            $table->char('nik', 5)->primary();
            $table->string('nama', 50);
            $table->char('departemen', 5);
            $table->foreign('departemen')->references('kodeDepartemen')->on('departemens')->onUpdate('cascade')->onDelete('restrict');
            $table->string('email', 100)->unique();
            $table->string('tel', 15)->unique();
            $table->enum('tipe', ['karyawan', 'admin', 'teknisi', 'pimpinan'])->default('karyawan');
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
};
