<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kolom untuk relasi dengan tabel users
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('address')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('photo')->nullable(); // Foto untuk alumni

            // Kolom untuk mitra
            $table->string('company_description')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_logo')->nullable(); // Foto logo perusahaan untuk mitra

            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
