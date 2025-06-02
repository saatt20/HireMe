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
            $table->string('program_studi')->nullable();
            $table->string('angkatan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn(['program_studi', 'angkatan']);
        });
    }

};
