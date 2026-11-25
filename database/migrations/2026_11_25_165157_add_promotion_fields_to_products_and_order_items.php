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
        Schema::table('products', function (Blueprint $table): void {
            $table->unsignedTinyInteger('discount_percent')->nullable();
            $table->dateTime('discount_starts_at')->nullable();
            $table->dateTime('discount_ends_at')->nullable();
        });

        Schema::table('order_items', function (Blueprint $table): void {
            $table->unsignedBigInteger('original_unit_price')->nullable();
            $table->unsignedTinyInteger('discount_percent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table): void {
            $table->dropColumn(['original_unit_price', 'discount_percent']);
        });

        Schema::table('products', function (Blueprint $table): void {
            $table->dropColumn(['discount_percent', 'discount_starts_at', 'discount_ends_at']);
        });
    }
};
