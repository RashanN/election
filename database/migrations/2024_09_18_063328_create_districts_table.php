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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID (Primary Key)
            $table->string('name');  // Name of the district
            $table->string('image')->nullable();  // Image URL for the district (nullable)
            $table->json('extra')->nullable();  // Extra field to store any additional info (optional JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
