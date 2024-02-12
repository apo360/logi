<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->enum('status', ['Ativo', 'Desativado', 'Pendente'])->default('Ativo');
            $table->dateTime('password_expired')->nullable();
            $table->tinyInteger('password_change_required')->default(0);
            $table->dateTime('last_access')->nullable();
            $table->unsignedBigInteger('role_id'); // Alterado para seguir convenção snake_case
            $table->unsignedInteger('empresa_id'); // Alterado para seguir convenção snake_case

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('empresa_id')->references('id')->on('empresa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
