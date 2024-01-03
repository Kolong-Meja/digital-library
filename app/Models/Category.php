<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'categories';

    protected $fillable = [
        'name', 
        'meta_title', 
        'description', 
        'meta_description',
        'status'
    ];

    protected $casts = [
        'status' => CategoryStatus::class
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_categories', 'category_id', 'book_id')->withTimestamps();
    }
}
