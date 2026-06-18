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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_admin')->default(false);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();

            $table->string('username', 255);  // New column


            $table->string('phone', 15)->nullable();  // New column
            $table->text('address')->nullable();  // New column
            $table->dateTime('dob')->nullable();  // New column
            $table->string('country')->nullable();  // New column
            $table->string('city_or_state')->nullable();  // New column
            $table->string('postal_code')->nullable();  // New column
            $table->string('ip_address')->nullable();  // New column
            $table->enum('role', ['customer', 'admin'])->default('customer');  // New column
            $table->tinyInteger('is_active')->default(1);  // New column
            $table->tinyInteger('is_notification_enable')->default(true);  // New column
            $table->tinyInteger('is_two_factor_auth_enable')->default(true);  // New column
            $table->string('otp')->nullable();
            $table->timestamp('otp_sent_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
