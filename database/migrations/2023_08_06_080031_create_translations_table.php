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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fruit_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->string('translated_title');
            $table->string('translated_heading_title_1');
            $table->string('translated_heading_title_2');
            $table->string('translated_heading_title_3');
            $table->tinyInteger('is_visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
