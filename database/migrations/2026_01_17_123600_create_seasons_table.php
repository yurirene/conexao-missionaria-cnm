<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('missionary_field_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('vacancies')->nullable();
            $table->json('desired_activities')->nullable();
            $table->timestamps();

            $table->foreign('missionary_field_id')->references('id')->on('missionary_fields')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
