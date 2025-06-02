<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRoleidTypeInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah dulu kolomnya menjadi nullable agar bisa di-drop di beberapa DB
            $table->dropColumn('roleid');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('alumni'); // Ganti dengan string, default 'alumni'
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('roleid')->default(3); // Kembalikan ke integer jika di-rollback
        });
    }
}
