<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpatisansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simpatisans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik_ktp')->unique();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('nama_provinsi')->default('default_value_here');
            $table->string('nama_kabupaten')->default('nilai_default_di_sini');
            $table->string('nama_kecamatan');
            $table->string('nama_desa');
            $table->string('rt_rw');
            $table->string('no_whatsapp');
            $table->string('nama_email');
            $table->string('upload_foto');
            $table->string('timses');
            $table->string('nama_petugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpatisans');
    }
}
