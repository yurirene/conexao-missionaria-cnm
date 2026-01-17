<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('church_name');
            $table->string('responsible_officer');
            $table->string('responsible_officer_phone');
            $table->json('activities')->nullable(); // Atividades que realizam
            $table->date('available_start')->nullable();
            $table->date('available_end')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('is_available');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_teams');
    }
};
