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
        Schema::create('fruit_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained();
            $table->foreignId('fruit_id')->constrained();
            $table->string('title_1');
            $table->string('title_2');
            $table->string('title_3');
            $table->string('heading_title_1');
            $table->string('heading_title_2');
            $table->string('heading_title_3');
            $table->mediumText('description_1');
            $table->mediumText('description_2');
            $table->mediumText('description_3');
            $table->longText('images')->nullable();
            $table->boolean('is_visible')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_translations');
    }
};
