<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missionary_fields', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->text('location_data')->nullable(); // JSON
            $table->text('description')->nullable();
            $table->json('structure')->nullable();
            $table->string('office_hours')->nullable();
            $table->json('activity_types')->nullable(); // Array de atividades
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missionary_fields');
    }
};
