<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Dönem Adı Örnek : Ocak Dönemi, Şubat Dönemi");
            $table->unsignedBigInteger('campaign_id')->comment("Kampanya ID");
            $table->timestamp('start_date')->comment("Başlangıç Tarihi : 1 Ocak");
            $table->timestamp("end_date")->comment("Bitiş Tarihi 31 Ocak");
            $table->float('min_price', 2, 10)->comment("Minimum Sepet Tutarı");
            $table->foreign('campaign_id')->references('id')->on('campaign')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_periods');
    }
};
