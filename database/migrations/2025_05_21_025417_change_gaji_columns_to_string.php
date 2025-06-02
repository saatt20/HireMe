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
            // Change gaji_min and gaji_max from decimal to string
            $table->string('gaji_min', 50)->nullable()->change();
            $table->string('gaji_max', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            // Change back to decimal if needed
            $table->decimal('gaji_min', 15, 2)->nullable()->change();
            $table->decimal('gaji_max', 15, 2)->nullable()->change();
        });
    }
};
