<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            if (! Schema::hasColumn('deposits', 'source')) {
                $table->string('source')->default('investment')->after('status');
            }

            if (! Schema::hasColumn('deposits', 'transaction_id')) {
                $table->foreignId('transaction_id')->nullable()->after('company_wallet_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            if (Schema::hasColumn('deposits', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }

            if (Schema::hasColumn('deposits', 'source')) {
                $table->dropColumn('source');
            }
        });
    }
};
