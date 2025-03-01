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
    Schema::create('tables', function (Blueprint $table) {
        $table->id();
        $table->integer('table_number')->unique();
        $table->integer('capacity');
        $table->string('location')->nullable();
        $table->enum('status', ['available', 'reserved', 'occupied', 'maintenance'])->default('available');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
