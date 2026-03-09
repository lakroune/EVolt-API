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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //foreign key de l'utilisateur
            $table->foreignId('charging_station_id')->constrained();  //foreign key de la station
            $table->timestamp('start_time'); //date de début
            $table->timestamp('end_time'); //date de fin
            $table->integer('estimated_duration_minutes'); //durée estimée en minutes
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled']) //status de la réservation
                ->default('pending'); //status par défaut
            $table->timestamp('notified_at')->nullable(); //date de notification bach neviter la redouble de notification
            $table->timestamps();  //timestamps(created_at et updated_at)
            // index pour les recherches
            $table->index(['charging_station_id', 'start_time', 'end_time']); //index sur la station, la date de début et la date de fin
            $table->index(['user_id', 'status']); //index sur l'utilisateur et le status
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
