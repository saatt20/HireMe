<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKualifikasiColumnOnLowongansTable extends Migration
{
    public function up()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->text('kualifikasi')->change(); // Mengubah kolom 'kualifikasi' menjadi tipe 'TEXT'
        });
    }

    public function down()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->string('kualifikasi', 255)->change(); // Kembalikan ke 'VARCHAR(255)' jika migrasi dibatalkan
        });
    }
}
