<?php

namespace App\Models;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $table = "books";

    protected $fillable = [
        'isbn',
        'image_cover',
        'title',
        'description',
        'synopsis',
        'page_count',
        'author_name',
        'publisher',
        'published',
        'uploaded_file',
        'status',
    ];

    protected $casts = [
        'published' => 'date',
        'status' => BookStatus::class
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id', 'category_id')->withTimestamps();
    }
}
