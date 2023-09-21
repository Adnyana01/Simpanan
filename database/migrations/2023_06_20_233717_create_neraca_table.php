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
        Schema::create('neraca', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kegiatan');
            $table->foreignId('kategori_neraca_id')->constrained('kategori_neraca', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_kegiatan', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kegiatan');
            $table->string('total_sample')->nullable();
            $table->string('target_sample');
            $table->string('keterangan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neraca');
    }
};
