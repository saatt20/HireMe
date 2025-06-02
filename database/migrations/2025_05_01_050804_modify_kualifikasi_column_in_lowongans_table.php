<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKualifikasiColumnInLowongansTable extends Migration
{
    public function up()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            // Mengubah kolom kualifikasi menjadi tipe TEXT
            $table->text('kualifikasi')->change();
        });
    }

    public function down()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            // Mengembalikan kolom kualifikasi ke tipe varchar(255) jika rollback
            $table->string('kualifikasi', 255)->change();
        });
    }
}
