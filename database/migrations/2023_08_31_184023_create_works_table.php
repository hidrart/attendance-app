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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->string('pic');
            $table->string('plant');
            $table->string('registration')->unique();
            $table->string('classification');
            $table->string('parameter');
            $table->string('wo')->nullable();
            $table->string('jpp')->nullable();
            $table->string('notification')->nullable();
            $table->string('equipment');
            $table->enum('frequency', ['Rutin', 'Tahunan']);
            $table->string('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
