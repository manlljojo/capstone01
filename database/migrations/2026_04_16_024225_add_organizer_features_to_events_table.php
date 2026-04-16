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
            $table->string('streaming_link')->nullable();
            $table->text('rundown')->nullable();
            $table->string('partner_streaming')->nullable(); // Zoom, YouTube, etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['streaming_link', 'rundown', 'partner_streaming']);
        });
    }
};
