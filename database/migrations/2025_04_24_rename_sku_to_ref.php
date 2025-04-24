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
        Schema::table('products', function (Blueprint $table) {
            // Check if sku column exists and ref column doesn't
            if (Schema::hasColumn('products', 'sku') && !Schema::hasColumn('products', 'ref')) {
                $table->renameColumn('sku', 'ref');
            }
            // If both columns exist (unlikely but just in case)
            else if (Schema::hasColumn('products', 'sku') && Schema::hasColumn('products', 'ref')) {
                $table->dropColumn('sku');
            }
            // If ref doesn't exist but sku also doesn't exist
            else if (!Schema::hasColumn('products', 'ref')) {
                $table->string('ref')->unique();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'ref') && !Schema::hasColumn('products', 'sku')) {
                $table->renameColumn('ref', 'sku');
            }
        });
    }
}; 