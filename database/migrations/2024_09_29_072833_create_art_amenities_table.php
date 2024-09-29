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
        Schema::create('art_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('art_id')->constrained('arts')->onDelete('cascade');
            $table->foreignId('amenity_id')->constrained('amenities');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('art_amenities');
    }
};
