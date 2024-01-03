<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'book_categories';

    protected $fillable = [
        'book_id', 'category_id'
    ];
}
