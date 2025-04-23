<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'cover_image',
        'available_copies',
        'book_state',
        'book_type'

    ];
}
