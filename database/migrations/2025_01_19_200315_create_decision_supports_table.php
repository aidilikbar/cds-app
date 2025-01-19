<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Do nothing. The table already exists in the shared database.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Do nothing.
    }
};
