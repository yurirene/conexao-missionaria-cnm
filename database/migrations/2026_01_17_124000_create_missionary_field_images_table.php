<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missionary_field_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('missionary_field_id');
            $table->string('image_path');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('missionary_field_id')->references('id')->on('missionary_fields')->onDelete('cascade');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missionary_field_images');
    }
};
