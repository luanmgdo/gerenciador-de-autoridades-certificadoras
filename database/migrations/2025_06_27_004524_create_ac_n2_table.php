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
        Schema::create('ac_n2', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj')->nullable()->default('');
            $table->string('tipo')->nullable()->default('');
            $table->string('situacao')->nullable()->default('');
            $table->string('credenciamento')->nullable()->default('');
            $table->string('telefone')->nullable()->default('');
            $table->foreignId('ac_id')->constrained('ac')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac_n2');
    }
};
