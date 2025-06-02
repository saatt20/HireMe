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
            $table->boolean('status_kerja')->default(false); // false = sudah bekerja, true = mencari kerja
        });
    }

    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn('status_kerja');
        });
    }

};
