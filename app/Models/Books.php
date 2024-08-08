<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = [
        'title',
        'author_id',
        'description',
        'thumbnail',
        'rating',
        'updated_at',
        'created_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'id');
    }

    public function dislike()
    {
        return $this->hasMany(Dislike::class, 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
