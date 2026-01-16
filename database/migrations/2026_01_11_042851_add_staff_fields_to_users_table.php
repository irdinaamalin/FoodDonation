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
            // Add staff_id if it doesn't exist
            if (!Schema::hasColumn('users', 'staff_id')) {
                $table->string('staff_id')->nullable()->unique()->after('matric_no');
            }
            
            // Add is_admin if it doesn't exist
            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false)->after('password');
            }

            // Make matric_no nullable
            $table->string('matric_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['staff_id', 'is_admin']);
        });
    }
};