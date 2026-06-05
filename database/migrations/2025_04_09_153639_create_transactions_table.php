<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // bigint primary key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_id');
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'transfer', 'purchase']);
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->enum('status', ['pending', 'success', 'cancelled'])->default('pending');

            // $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
