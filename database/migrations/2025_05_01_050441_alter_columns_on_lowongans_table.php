<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsOnLowongansTable extends Migration
{
    public function up()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->string('judul')->nullable(false)->change();
            $table->text('deskripsi')->nullable(false)->change();
            $table->string('kualifikasi')->nullable(false)->change();
            $table->string('skills')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
            $table->string('kota')->nullable(false)->change();
            $table->string('provinsi')->nullable(false)->change();
            $table->date('deadline')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->string('judul')->nullable()->change();
            $table->text('deskripsi')->nullable()->change();
            $table->string('kualifikasi')->nullable()->change();
            $table->string('skills')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('kota')->nullable()->change();
            $table->string('provinsi')->nullable()->change();
            $table->date('deadline')->nullable()->change();
        });
    }
}
