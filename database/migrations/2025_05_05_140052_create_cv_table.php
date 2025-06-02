<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cv', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('tentang_saya');
        $table->string('tingkat_pendidikan')->nullable();
        $table->string('jurusan')->nullable();
        $table->string('nama_sekolah')->nullable();
        $table->string('tahun_mulai_pendidikan')->nullable();
        $table->string('tahun_lulus')->nullable();
        $table->string('lokasi_pendidikan')->nullable();
        $table->text('info_tambahan_pendidikan')->nullable();

        $table->string('nama_perusahaan')->nullable();
        $table->string('posisi_kerja')->nullable();
        $table->string('tahun_mulai_kerja')->nullable();
        $table->string('tahun_selesai_kerja')->nullable();
        $table->string('lokasi_kerja')->nullable();
        $table->text('info_tambahan_kerja')->nullable();

        $table->string('nama_organisasi')->nullable();
        $table->string('posisi_organisasi')->nullable();
        $table->string('tahun_mulai_organisasi')->nullable();
        $table->string('tahun_selesai_organisasi')->nullable();
        $table->string('lokasi_organisasi')->nullable();
        $table->text('info_tambahan_organisasi')->nullable();

        $table->text('skill')->nullable();

        $table->string('nama_penghargaan')->nullable();
        $table->string('penyelenggara')->nullable();
        $table->string('tahun_penghargaan')->nullable();
        $table->string('lokasi_penghargaan')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv');
    }
};
