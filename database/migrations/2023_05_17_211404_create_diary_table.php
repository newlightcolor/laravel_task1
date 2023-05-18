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
        Schema::create('diary', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable(true);
            $table->text('image_url')->nullable(true);
            $table->text('small_image_url')->nullable(true);
            $table->text('local_image_path')->nullable(true);
            $table->text('local_small_image_path')->nullable(true);
            $table->text('original_image_name')->nullable(true);
            $table->tinyInteger('delete_flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary');
    }
};
