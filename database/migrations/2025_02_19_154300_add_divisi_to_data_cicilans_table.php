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
        Schema::table('data_cicilans', function (Blueprint $table) {
            $table->string('divisi')->nullable()->default('Bukan Borongan')->after('nama_konsumen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_cicilans', function (Blueprint $table) {
            $table->dropColumn('divisi');
        });
    }
};
