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
        Schema::create('accounts', function (Blueprint $table) {
                $table->id(); // bigint primary key
                $table->unsignedBigInteger('user_id');
                $table->string('account_number', 20)->unique();
                $table->string('routine', length: 9)->unique()->nullable();

                $table->decimal('balance', 15, 2);
                $table->boolean('is_suspended')->default(false);
                $table->timestamps(); // created_at & updated_at
        
                // Foreign key constraint (optional but recommended)
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
