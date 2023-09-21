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
        Schema::create('neraca_child', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('neraca', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_kegiatan', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neraca_children');
    }
};
