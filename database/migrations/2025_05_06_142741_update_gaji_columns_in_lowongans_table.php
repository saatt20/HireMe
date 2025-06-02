<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGajiColumnsInLowongansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            // Hapus kolom 'gaji_thp' yang lama
            $table->dropColumn('gaji_thp');

            // Tambahkan kolom baru 'gaji_min' dan 'gaji_max'
            $table->decimal('gaji_min', 15, 2)->nullable()->after('provinsi');
            $table->decimal('gaji_max', 15, 2)->nullable()->after('gaji_min');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lowongans', function (Blueprint $table) {
            // Kembalikan kolom 'gaji_thp' jika migration dibatalkan
            $table->decimal('gaji_thp', 15, 2)->nullable()->after('provinsi');

            // Hapus kolom 'gaji_min' dan 'gaji_max' jika rollback
            $table->dropColumn('gaji_min');
            $table->dropColumn('gaji_max');
        });
    }
}
