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
        Schema::create('campaign_period_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('period_id')->comment("Dönem ID");
            $table->foreign('period_id')->references('id')->on('campaign_periods')->onDelete('cascade');

            $table->unsignedBigInteger("product_id")->comment("Ürün ID");
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_period_products');
    }
};
