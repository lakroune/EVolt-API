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
        Schema::create('charging_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->decimal('energy_delivered_kwh', 8, 2)->default(0);
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->enum('status', ['in_progress', 'completed', 'failed'])->default('in_progress');
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_sessions');
    }
};
