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
        // Schema::rename('admin', 'users'); // Table already renamed or created as users
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('id');
            $table->string('role')->default('peserta')->after('password');
        });
        
        \Illuminate\Support\Facades\DB::table('users')->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'role']);
        });
        // Schema::rename('users', 'admin');
    }
};
