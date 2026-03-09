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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //primary key
            $table->string('name'); //nom de l'utilisateur
            $table->string('email')->unique(); //email de l'utilisateur
            $table->timestamp('email_verified_at')->nullable(); //date de vérification de l'email
            $table->string('password'); //mot de passe
            $table->rememberToken(); //token de rappel
            $table->timestamps(); // timestamps(created_at et updated_at)
            $table->softDeletes();  //soft delete
            $table->index(['email', 'deleted_at']); //index sur l'email
            $table->enum('role', ['admin', 'user'])->default('user'); //role de l'utilisateur
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
