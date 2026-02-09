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
        Schema::create('love_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('message', 500);
            $table->string('contact_method', 20);
            $table->string('contact_value', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('love_messages');
    }
};
