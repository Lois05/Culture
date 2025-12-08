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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->bigIncrements('id_commentaire');
            $table->text('texte');
            $table->integer('note')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->unsignedBigInteger('id_utilisateur');
            $table->unsignedBigInteger('id_contenu');
            $table->timestamps();

            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
