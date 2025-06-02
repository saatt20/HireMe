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
            $table->json('riwayat_pendidikan')->nullable()->after('tentang_saya');
            $table->json('pengalaman_kerja')->nullable()->after('riwayat_pendidikan');
            $table->json('pengalaman_organisasi')->nullable()->after('pengalaman_kerja');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cv', function (Blueprint $table) {
            //
        });
    }
};
