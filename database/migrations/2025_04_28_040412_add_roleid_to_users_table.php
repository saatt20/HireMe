<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleidToUsersTable extends Migration
{
    /**
     * Jalankan migrasi untuk menambahkan kolom roleid ke tabel users.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('roleid')->default(3); // Misalnya 3 adalah nilai default untuk role alumni
        });
    }

    /**
     * Rollback migrasi (untuk menghapus kolom roleid).
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roleid');
        });
    }
}
