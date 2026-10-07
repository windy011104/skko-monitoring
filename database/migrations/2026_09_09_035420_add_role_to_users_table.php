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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email'); // 'admin' or 'user'
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('unit_kerja')->nullable()->after('role');
            $table->string('jabatan')->nullable()->after('unit_kerja');
            $table->boolean('is_active')->default(true)->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'username', 'unit_kerja', 'jabatan', 'is_active']);
        });
    }
};
