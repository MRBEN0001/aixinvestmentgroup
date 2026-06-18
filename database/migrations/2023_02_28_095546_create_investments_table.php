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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_wallet_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->double('amount');
            $table->double('roi')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('Pending');
            $table->boolean('has_withdrawn')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
};
