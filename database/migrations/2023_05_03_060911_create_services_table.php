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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->json('urgent');
            $table->json('unurgent');
            $table->json('schedual');
            $table->string('inperson');
            $table->string('audiovideo');
            $table->string('onlineaudiovideo');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('radius')->nullable();
            $table->string('urgentprice');
            $table->string('unurgentprice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
