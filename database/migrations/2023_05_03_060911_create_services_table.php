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
            $table->foreignuuid('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->json('urgent')->nullable();
            $table->json('unurgent')->nullable();
            $table->json('schedual')->nullable();
            $table->string('inperson')->nullable();
            $table->string('audiovideo')->nullable();
            $table->string('onlineaudiovideo')->nullable();
            $table->boolean('isInperson')->default('false');
            $table->boolean('isdocument')->default('false');
            $table->boolean('isAudioVideo')->default('false');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('radius')->nullable();
            $table->string('urgentprice')->nullable();
            $table->string('unurgentprice')->nullable();
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
