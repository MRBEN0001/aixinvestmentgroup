<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('status');
            $table->date('next_payment_date')->nullable()->after('start_date');
            $table->integer('working_days_paid')->default(0)->after('next_payment_date');
            $table->date('last_payment_date')->nullable()->after('working_days_paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('next_payment_date');
            $table->dropColumn('working_days_paid');
            $table->dropColumn('last_payment_date');
        });
    }
};
