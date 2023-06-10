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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->enum('scheduletype', ['audio/video', 'inPerson', ])->nullable();      
            $table->enum('servicetype', ['instant', 'schedule', 'document'])->default('instant');
            $table->enum('meetingtype', ['audio', 'video'])->nullable();
            $table->integer('price');
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->date('date');
            $table->integer('duration')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
