<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();

            // Form bilgisi
            $table->string('form_type', 20)->nullable();   // simple
            $table->string('source')->nullable();          // landing slug
            $table->string('locale', 10)->nullable();

            // Geo
            $table->string('geo_country', 5)->nullable();
            $table->string('geo_region', 80)->nullable();
            $table->string('geo_city', 80)->nullable();

            // Core
            $table->string('name', 120)->nullable();
            $table->string('company', 160)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 180)->nullable();
            $table->text('message')->nullable();

            // Free-form
            $table->json('details')->nullable();

            // Technical
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
