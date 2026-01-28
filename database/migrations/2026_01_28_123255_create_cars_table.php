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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('car_brand_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('car_category_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('title');
            $table->string('model');
            $table->year('year');

            $table->string('registration_number')->unique();

            $table->decimal('price_per_day', 10, 2);
            $table->integer('seats');

            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid']);
            $table->text('description')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
