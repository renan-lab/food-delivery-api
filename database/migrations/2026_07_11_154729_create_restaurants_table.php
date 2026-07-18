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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('trade_name', 150);
            $table->string('company_name', 150);
            $table->string('cnpj', 14)->unique();
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('phone', 20);
            $table->string('postal_code', 8);
            $table->string('street', 255);
            $table->string('number', 20);
            $table->string('complement', 150)->nullable();
            $table->string('district', 100);
            $table->string('city', 100);
            $table->char('state', 2);
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('trade_name');
            $table->index('city');
            $table->index('state');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
