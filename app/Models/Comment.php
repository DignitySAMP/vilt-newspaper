<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = ['article_id', 'user_id', 'content'];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function article(): BelongsTo {
        return $this->belongsTo(Article::class);
    }
}
