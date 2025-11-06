<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content', 'summary', 'image'
    ];
    protected $appends = [
        'read_time', 'image_url'
    ];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function comment(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function getReadTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200); // https://irisreading.com/what-is-the-average-reading-speed/ - 200wpm
    
        return $minutes;
    }
    
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
    
        // theoretically we dont need to check for the image url here, but for demo purposes in conjunction with db:seed, we add support for hardcoded image urls...
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        else if (Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        
        return null;
    }
}
