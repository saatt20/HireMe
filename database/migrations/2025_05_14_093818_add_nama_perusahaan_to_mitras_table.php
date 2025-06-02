<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mitras', function (Blueprint $table) {
            $table->string('nama_perusahaan')->after('user_id')->nullable();
            // $table->string('logo')->after('nama_perusahaan')->nullable()->default(null)->comment('Logo Perusahaan Mitra');
            // $table->string('kota')->after('logo')->nullable()->default(null)->comment('Kota Perusahaan Mitra');
            // $table->string('provinsi')->after('kota')->nullable()->default(null)->comment('Provinsi Perusahaan Mitra');
            // $table->string('telepon')->after('provinsi')->nullable()->default(null)->comment('Telepon Perusahaan Mitra');
            // $table->text('deskripsi')->after('telepon')->nullable()->default(null)->comment('Deskripsi Perusahaan Mitra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitras', function (Blueprint $table) {
            //
        });
    }
};
