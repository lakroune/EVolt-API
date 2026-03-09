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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('charging_station_id')->constrained();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->integer('estimated_duration_minutes');
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])
                ->default('pending');
            $table->timestamp('notified_at')->nullable(); 
            $table->timestamps();

            $table->index(['charging_station_id', 'start_time', 'end_time']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
