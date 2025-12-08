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
        Schema::create('parler', function (Blueprint $table) {
            $table->id('id_parler'); // AUTO-INCREMENT

            $table->unsignedBigInteger('id_region');
            $table->unsignedBigInteger('id_langue');

            $table->foreign('id_region')->references('id_region')->on('regions')->onDelete('cascade');
            $table->foreign('id_langue')->references('id_langue')->on('langues')->onDelete('cascade');
            $table->timestamps(); // ajoute created_at et updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parler');
    }
};
