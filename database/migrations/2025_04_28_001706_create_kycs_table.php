<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kycs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->enum('id_type', ['passport', 'national_id', 'driver_license', 'voter_card']);
            $table->string('id_document_front');
            $table->string('id_document_back')->nullable(); // in case the doc has only front
            $table->string('selfie')->nullable();            // in case selfie isn't required immediately
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kycs');
    }
};
