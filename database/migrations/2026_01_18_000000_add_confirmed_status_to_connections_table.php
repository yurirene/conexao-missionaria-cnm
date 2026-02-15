<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL não permite alterar ENUM diretamente, então precisamos usar ALTER TABLE
        DB::statement("ALTER TABLE connections MODIFY COLUMN status ENUM('sent', 'received', 'accepted', 'confirmed', 'rejected', 'cancelled', 'completed') DEFAULT 'sent'");
    }

    public function down(): void
    {
        // Reverter para o enum original
        DB::statement("ALTER TABLE connections MODIFY COLUMN status ENUM('sent', 'received', 'accepted', 'rejected', 'cancelled', 'completed') DEFAULT 'sent'");
    }
};
