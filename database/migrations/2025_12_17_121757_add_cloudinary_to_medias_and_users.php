<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table medias
        if (Schema::hasTable('medias')) {
            Schema::table('medias', function (Blueprint $table) {
                if (!Schema::hasColumn('medias', 'cloudinary_url')) {
                    $table->string('cloudinary_url')->nullable()->after('chemin');
                }
                if (!Schema::hasColumn('medias', 'cloudinary_public_id')) {
                    $table->string('cloudinary_public_id')->nullable()->after('cloudinary_url');
                }
                if (!Schema::hasColumn('medias', 'has_cloudinary')) {
                    $table->boolean('has_cloudinary')->default(false)->after('cloudinary_public_id');
                }
                if (!Schema::hasColumn('medias', 'image_thumbnail')) {
                    $table->string('image_thumbnail')->nullable()->after('has_cloudinary');
                }
            });
        }

        // Table users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'cloudinary_url')) {
                    $table->string('cloudinary_url')->nullable()->after('photo');
                }
                if (!Schema::hasColumn('users', 'cloudinary_public_id')) {
                    $table->string('cloudinary_public_id')->nullable()->after('cloudinary_url');
                }
                if (!Schema::hasColumn('users', 'has_cloudinary')) {
                    $table->boolean('has_cloudinary')->default(false)->after('cloudinary_public_id');
                }
                if (!Schema::hasColumn('users', 'image_thumbnail')) {
                    $table->string('image_thumbnail')->nullable()->after('has_cloudinary');
                }
            });
        }
    }

    public function down()
    {
        // Table medias
        if (Schema::hasTable('medias')) {
            Schema::table('medias', function (Blueprint $table) {
                $columns = ['cloudinary_url', 'cloudinary_public_id', 'has_cloudinary', 'image_thumbnail'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('medias', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Table users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $columns = ['cloudinary_url', 'cloudinary_public_id', 'has_cloudinary', 'image_thumbnail'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
