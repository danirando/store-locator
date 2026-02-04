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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('indirizzo');
            $table->string('città');
            $table->decimal('latitudine', 10, 8);
            $table->decimal('longitudine', 11, 8);
            $table->string('telefono')->nullable();
            $table->string('totem'); // Adjusted to string as per user request allowing flexible choice
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
