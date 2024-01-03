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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('isbn', 13)
            ->nullable(false)
            ->unique();
            $table->string('image_cover')
            ->nullable(false);
            $table->string('title', 255)
            ->nullable(false);
            $table->text('description')
            ->nullable(false);
            $table->text('synopsis')
            ->nullable(false);
            $table->integer('page_count')
            ->default(0)
            ->nullable(false);
            $table->string('author_name', 255)
            ->nullable(false);
            $table->string('publisher', 255)
            ->nullable(false);
            $table->date('published')
            ->nullable(false);
            $table->string('uploaded_file')
            ->nullable(false);
            $table->enum('status', ['pending', 'displayed'])
            ->default('pending')
            ->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
