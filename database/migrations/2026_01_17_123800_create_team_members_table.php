<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('team_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('church')->nullable();
            $table->string('pastor_name')->nullable();
            $table->string('pastor_phone')->nullable();
            $table->string('role')->nullable();
            $table->string('photo_path')->nullable();
            $table->text('description')->nullable();
            $table->text('specialty')->nullable();
            $table->enum('status', ['pending', 'paid', 'rejected'])->default('pending');
            $table->json('file_paths')->nullable(); // Caminhos dos documentos seguros
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('volunteer_teams')->onDelete('cascade');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
