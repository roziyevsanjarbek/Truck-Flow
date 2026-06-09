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
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id')->unique();
            $table->string('state')->default('start');
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('from_country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('from_city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('to_country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('to_city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_users');
    }
};
