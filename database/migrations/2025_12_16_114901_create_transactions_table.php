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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('reference')->unique();
        $table->decimal('amount', 10, 2);
        $table->string('currency', 10)->default('FCFA');
        $table->string('operator')->nullable(); // mtn, moov
        $table->string('phone_number')->nullable();
        $table->string('description');
        $table->string('status')->default('pending'); // pending, completed, failed, cancelled
        $table->json('metadata')->nullable();
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
