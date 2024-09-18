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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID (Primary Key)
            $table->string('name');  // Name of the party
            $table->string('abbreviation', 10)->nullable();  // Party abbreviation with a max length of 10 characters
            $table->string('logo')->nullable();  // Party logo URL (nullable if no logo is provided)
            $table->string('candidate_name');  // Candidate's name (this is required)
            $table->timestamps();  // Created at and updated at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
