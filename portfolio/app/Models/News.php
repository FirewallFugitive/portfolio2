<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'content',
        'publication_date',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
