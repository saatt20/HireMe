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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->string('tipe'); // fulltime, parttime, internship
            $table->string('kualifikasi'); // Kolom kualifikasi
            $table->string('skills'); // Kolom skills
            $table->string('status')->default('Aktif'); // Kolom status
            $table->string('kota'); // Kolom kota
            $table->string('provinsi'); // Kolom provinsi
            $table->date('deadline'); // Kolom deadline
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
