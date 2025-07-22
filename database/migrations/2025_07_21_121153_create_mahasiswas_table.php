<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nim')->unique();
        $table->integer('angkatan');
        $table->string('prodi');
        $table->integer('tahun');
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};