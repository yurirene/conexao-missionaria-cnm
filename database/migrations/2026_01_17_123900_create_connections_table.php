<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('missionary_field_id')->nullable();
            $table->uuid('volunteer_team_id')->nullable();
            $table->uuid('season_id')->nullable(); // Opcional: conexão específica com temporada
            $table->enum('status', ['sent', 'received', 'accepted', 'rejected', 'cancelled', 'completed'])->default('sent');
            $table->enum('initiator_type', ['missionary', 'volunteer']);
            $table->timestamps();

            $table->foreign('missionary_field_id')->references('id')->on('missionary_fields')->onDelete('cascade');
            $table->foreign('volunteer_team_id')->references('id')->on('volunteer_teams')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('set null');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
