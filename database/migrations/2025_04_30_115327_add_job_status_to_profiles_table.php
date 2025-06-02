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
    Schema::table('profiles', function (Blueprint $table) {
        $table->string('job_status')->default('not_active'); // Atur default jika perlu
    });
}

public function down()
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->dropColumn('job_status');
    });
}
};
