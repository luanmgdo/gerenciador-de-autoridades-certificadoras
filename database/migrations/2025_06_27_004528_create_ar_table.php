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
        Schema::create('ar', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj')->nullable()->default('');
            $table->string('tipo')->nullable()->default('');
            $table->string('situacao')->nullable()->default('');
            $table->string('credenciamento')->nullable()->default('');
            $table->string('telefone')->nullable()->default('');
            $table->foreignId('ac_n2_id')->constrained('ac_n2')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar');
    }
};
