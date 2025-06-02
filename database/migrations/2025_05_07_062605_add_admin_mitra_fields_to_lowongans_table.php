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
        Schema::table('lowongans', function (Blueprint $table) {
            $table->string('mitra_nama')->nullable();
            $table->text('mitra_deskripsi')->nullable();
            $table->string('mitra_logo')->nullable();
            $table->string('link_pendaftaran')->nullable(); // untuk admin
            $table->string('created_by_role')->default('mitra'); // 'mitra' atau 'admin'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            //
        });
    }
};
