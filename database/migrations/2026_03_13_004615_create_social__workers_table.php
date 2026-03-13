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
        Schema::create('social_workers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('specialization');
            $table->string('phone', 11);
            $table->string('address');
            $table->integer('age');
            $table->string('email');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_workers');
    }
};
