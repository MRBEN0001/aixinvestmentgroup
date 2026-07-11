<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            if (! Schema::hasColumn('withdrawals', 'source')) {
                $table->string('source')->default('investment')->after('status');
            }

            if (! Schema::hasColumn('withdrawals', 'wallet_address')) {
                $table->string('wallet_address')->nullable()->after('amount');
            }

            if (! Schema::hasColumn('withdrawals', 'transaction_id')) {
                $table->unsignedBigInteger('transaction_id')->nullable()->after('company_wallet_id');
            }

            if (! Schema::hasColumn('withdrawals', 'usd_value')) {
                $table->decimal('usd_value', 15, 2)->nullable()->after('amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            foreach (['usd_value', 'transaction_id', 'wallet_address', 'source'] as $column) {
                if (Schema::hasColumn('withdrawals', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
