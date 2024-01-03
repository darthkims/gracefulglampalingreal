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
        Schema::table('product_size', function (Blueprint $table) {
            $table->integer('stocks')->nullable();
        });

        Schema::table('product_color', function (Blueprint $table) {
            $table->integer('stocks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_size', function (Blueprint $table) {
            $table->dropColumn('stocks');
        });

        Schema::table('product_color', function (Blueprint $table) {
            $table->dropColumn('stocks');
        });
    }
};
