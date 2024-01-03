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
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 30)->nullable(false);
            $table->string('meta_title', 30)->nullable(false);
            $table->text('description')->nullable(false);
            $table->text('meta_description')->nullable(false);
            $table->enum('status', ['deprecated', 'active'])
            ->default('deprecated')
            ->nullable(false);
            $table->index(['name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
