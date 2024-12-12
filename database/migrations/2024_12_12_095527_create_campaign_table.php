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
        Schema::create('campaign', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Kampanya Adı");
            $table->date("start_date")->nullable()->comment("Kampanya Tarihi");
            $table->date("end_date")->nullable()->comment("Kampanya Tarihi");
            $table->string("description")->comment("Kampamya Açklaması");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign');
    }
};
