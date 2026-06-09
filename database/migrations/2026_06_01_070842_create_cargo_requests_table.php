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
        Schema::create('cargo_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('driver_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('from_country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('from_city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('to_country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('to_city_id')->constrained('cities')->cascadeOnDelete();
            $table->date('unloading_date')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_requests');
    }
};
