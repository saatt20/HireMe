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
        Schema::table('alumnis', function (Blueprint $table) {
            // Mengubah kolom status_kerja menjadi ENUM
            $table->enum('status_kerja', ['Mencari Kerja', 'Sudah Bekerja'])
                  ->default('Mencari Kerja')
                  ->change(); // Ubah kolom dengan 'change()'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Kembalikan kolom status_kerja ke tipe TINYINT
        Schema::table('alumnis', function (Blueprint $table) {
            $table->tinyInteger('status_kerja')->default(0)->change(); // Kembalikan tipe ke TINYINT
        });
    }
};
