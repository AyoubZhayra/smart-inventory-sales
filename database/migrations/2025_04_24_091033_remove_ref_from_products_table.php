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
            // Check if the column exists before trying to drop it
            if (Schema::hasColumn('products', 'ref')) {
                 $table->dropColumn('ref');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the column back, make it unique and nullable initially if needed, adjust as necessary
             $table->string('ref')->nullable()->unique()->after('cost_price'); 
        });
    }
};
