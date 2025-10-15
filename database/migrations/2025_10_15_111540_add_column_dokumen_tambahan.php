<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->longText('dokumen_pendukung_tambahan')->nullable()->after('dokumen_rekomendasi');
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn('dokumen_pendukung_tambahan');
        });
    }
};
