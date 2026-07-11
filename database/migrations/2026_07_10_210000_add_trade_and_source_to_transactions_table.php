<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (! Schema::hasColumn('transactions', 'source')) {
                $table->string('source')->default('investment')->after('status');
            }
        });

        // Expand enum to include trade (MySQL)
        try {
            DB::statement("ALTER TABLE transactions MODIFY transaction_type ENUM('deposit', 'withdrawal', 'transfer', 'purchase', 'trade') NOT NULL");
        } catch (\Throwable $e) {
            // SQLite / non-MySQL environments may not support MODIFY ENUM
        }
    }

    public function down(): void
    {
        try {
            DB::statement("ALTER TABLE transactions MODIFY transaction_type ENUM('deposit', 'withdrawal', 'transfer', 'purchase') NOT NULL");
        } catch (\Throwable $e) {
            // ignore
        }

        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'source')) {
                $table->dropColumn('source');
            }
        });
    }
};
