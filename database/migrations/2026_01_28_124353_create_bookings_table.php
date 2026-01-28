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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('car_id')
            ->constrained()
            ->onDelete('cascade');

        $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

        $table->foreignId('owner_id')
            ->constrained('users')
            ->onDelete('cascade');

        $table->date('start_date');
        $table->date('end_date');

        $table->integer('total_days');
        $table->decimal('price_per_day', 10, 2);
        $table->decimal('total_price', 10, 2);

        $table->enum('status', [
            'pending',
            'confirmed',
            'cancelled',
            'completed'
        ])->default('pending');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
