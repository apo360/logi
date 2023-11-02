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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('FuncionarioID', 30)->unique();
            $table->string('Nome', 200);
            $table->string('Apelido', 75);
            $table->string('Email', 200)->nullable();
            $table->string('Telefone', 20);
            $table->string('Endereco', 230);
            $table->string('N_bi', 200)->unique();
            $table->date('data_nasc');
            $table->enum('Genero', ['M','F'])->default('M');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('CompanyID');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('CompanyID')->references('CompanyID')->on('Header')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
};
