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
        Schema::create('charging_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //nom de la station
            $table->decimal('power_kw', 8, 2); //puissance de la station
            $table->decimal('latitude', 10, 8); //latitude de la station
            $table->decimal('longitude', 11, 8); //longitude de la station
            $table->string('address');  //adresse de la station
            $table->enum('status', ['available', 'occupied', 'maintenance', 'offline'])
                ->default('available'); //status de la station
            $table->decimal('price_per_kwh', 8, 2)->nullable();  //prix de la station
            $table->softDeletes();  //soft delete
            $table->index(['latitude', 'longitude']); //index spatial pour la géolocalisation
            $table->timestamps(); //timestamps  (created_at et updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_stations');
    }
};
