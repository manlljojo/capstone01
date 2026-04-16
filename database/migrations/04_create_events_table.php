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
        Schema::create('events', function (Blueprint $table) {
            $table->id('id_event');
            $table->unsignedBigInteger('id_penyelenggara')->nullable();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('nama_event', 100);
            $table->text('deskripsi');
            $table->date('tanggal_event');
            $table->string('lokasi', 255);
            $table->string('status_event', 50)->default('Aktif');
            
            // Existing fields for compatibility
            $table->string('banner')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('kuota')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('durasi')->nullable();
            $table->string('faktor_pembatas')->nullable();
            
            $table->timestamps();

            $table->foreign('id_penyelenggara')->references('id_penyelenggara')->on('penyelenggaras')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
