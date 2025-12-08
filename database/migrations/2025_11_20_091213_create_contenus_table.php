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
       Schema::create('contenus', function (Blueprint $table) {
            $table->bigIncrements('id_contenu');
            $table->string('titre');
            $table->text('texte')->nullable();
            $table->timestamp('date_creation')->useCurrent();
            $table->string('statut')->default('en_attente');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('id_region');
            $table->unsignedBigInteger('id_langue');
            $table->unsignedBigInteger('id_moderateur')->nullable();
            $table->unsignedBigInteger('id_type_contenu');
            $table->unsignedBigInteger('id_auteur');
            $table->timestamp('date_validation')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id_contenu')->on('contenus')->onDelete('cascade');
            $table->foreign('id_region')->references('id_region')->on('regions')->onDelete('cascade');
            $table->foreign('id_langue')->references('id_langue')->on('langues')->onDelete('cascade');
            $table->foreign('id_moderateur')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_type_contenu')->references('id_type_contenu')->on('type_contenus')->onDelete('cascade');
            $table->foreign('id_auteur')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
