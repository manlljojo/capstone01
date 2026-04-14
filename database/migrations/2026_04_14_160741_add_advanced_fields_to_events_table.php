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
        Schema::table('events', function (Blueprint $table) {
            $table->integer('kuota')->default(100);
            $table->integer('kapasitas')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('durasi')->nullable();
            $table->string('faktor_pembatas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['kuota', 'kapasitas', 'jam_operasional', 'durasi', 'faktor_pembatas']);
        });
    }
};
