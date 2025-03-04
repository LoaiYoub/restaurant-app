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
        Schema::table('menu_items', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('menu_items', 'is_vegetarian')) {
                $table->boolean('is_vegetarian')->default(false);
            }

            if (!Schema::hasColumn('menu_items', 'is_gluten_free')) {
                $table->boolean('is_gluten_free')->default(false);
            }

            if (!Schema::hasColumn('menu_items', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }

            if (!Schema::hasColumn('menu_items', 'availability')) {
                $table->enum('availability', ['in_stock', 'out_of_stock'])->default('in_stock');
            }

            if (!Schema::hasColumn('menu_items', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active');
            }

            if (!Schema::hasColumn('menu_items', 'preparation_time')) {
                $table->integer('preparation_time')->nullable()->comment('Preparation time in minutes');
            }

            if (!Schema::hasColumn('menu_items', 'calories')) {
                $table->integer('calories')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            // Drop the columns in reverse order
            $table->dropColumn([
                'calories',
                'preparation_time',
                'status',
                'availability',
                'is_featured',
                'is_gluten_free',
                'is_vegetarian'
            ]);
        });
    }
};
