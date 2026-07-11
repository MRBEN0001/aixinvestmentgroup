<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            if (! Schema::hasColumn('deposits', 'balance_credited')) {
                $table->boolean('balance_credited')->default(false)->after('status');
            }

            if (! Schema::hasColumn('deposits', 'credited_units')) {
                $table->decimal('credited_units', 20, 8)->nullable()->after('balance_credited');
            }
        });
    }

    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            if (Schema::hasColumn('deposits', 'credited_units')) {
                $table->dropColumn('credited_units');
            }

            if (Schema::hasColumn('deposits', 'balance_credited')) {
                $table->dropColumn('balance_credited');
            }
        });
    }
};
