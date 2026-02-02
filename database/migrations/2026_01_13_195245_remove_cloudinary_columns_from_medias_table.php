<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('medias', function (Blueprint $table) {
            // Supprimer toutes les colonnes Cloudinary
            $table->dropColumn('cloudinary_url');
            $table->dropColumn('cloudinary_public_id');
            $table->dropColumn('has_cloudinary');
            $table->dropColumn('image_thumbnail');
        });
    }

    public function down()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->string('cloudinary_url')->nullable();
            $table->string('cloudinary_public_id')->nullable();
            $table->boolean('has_cloudinary')->default(false);
            $table->string('image_thumbnail')->nullable();
        });
    }
};
