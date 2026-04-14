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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('filament')->nullable();
            $table->integer('pieces')->nullable();
            $table->string('print_time')->nullable();
            $table->string('supports')->nullable();
            $table->string('infill')->nullable();
            $table->string('layer_height')->nullable();
            $table->string('file_format')->nullable();
            $table->string('license')->nullable();
            $table->string('main_image')->nullable();
            $table->integer('rating_count')->default(0);
            $table->decimal('rating_avg', 3, 1)->default(0);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
