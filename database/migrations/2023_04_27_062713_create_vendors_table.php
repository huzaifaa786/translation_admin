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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('DOB');
            $table->string('api_token');
            $table->string('passport');
            $table->string('number')->nullable();
            $table->string('profilepic')->nullable();
            $table->string('certificate')->nullable();;
            $table->string('status')->default(0);
            $table->boolean('online')->default(1);
            $table->string('language');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
