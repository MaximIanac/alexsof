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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->boolean('attending');
            $table->boolean('attending_with_partner')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('partner_first_name')->nullable();
            $table->string('partner_last_name')->nullable();
            $table->text('drink_preferences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
