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
    Schema::table('cv', function (Blueprint $table) {
        // Hapus kolom lama
        $table->dropColumn([
            'tingkat_pendidikan',
            'jurusan',
            'nama_sekolah',
            'tahun_mulai_pendidikan',
            'tahun_lulus',
            'lokasi_pendidikan',
            'info_tambahan_pendidikan',

            'nama_perusahaan',
            'posisi_kerja',
            'tahun_mulai_kerja',
            'tahun_selesai_kerja',
            'lokasi_kerja',
            'info_tambahan_kerja',

            'nama_organisasi',
            'posisi_organisasi',
            'tahun_mulai_organisasi',
            'tahun_selesai_organisasi',
            'lokasi_organisasi',
            'info_tambahan_organisasi',

            'nama_penghargaan',
            'penyelenggara',
            'tahun_penghargaan',
            'lokasi_penghargaan'
        ]);

        // Tambahkan kolom baru
        $table->json('riwayat_pendidikan')->nullable();
        $table->json('pengalaman_kerja')->nullable();
        $table->json('pengalaman_organisasi')->nullable();
        $table->json('penghargaan')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('use_json_fields', function (Blueprint $table) {
            //
        });
    }
};
