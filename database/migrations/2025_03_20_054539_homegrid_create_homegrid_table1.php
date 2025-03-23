<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('home_grids', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('key', 120);
            $table->string('description', 400)->nullable();
            $table->string('style', 60)->default('style-1');
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('home_grid_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('home_grid_id');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('bg_color', 20)->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_type', 20)->nullable();
            $table->integer('order')->unsigned()->default(0);
            $table->string('button_color', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_grids');
        Schema::dropIfExists('home_grid_items');
    }
};