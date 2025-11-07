<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewsletterMail;
use App\Models\User;

class Newsletter extends Model
{
    /** @use HasFactory<\Database\Factories\NewsletterFactory> */
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public static function sendToAll(string $subject, string $content, string $buttonText, string $buttonUrl): int
    {
        $newsletters = self::with('user')->get();
        $count = 0;
    
        foreach ($newsletters as $newsletter) {
            if ($newsletter->user && $newsletter->user->email) {
                Mail::to($newsletter->user->email)->send( // TODO: ->queue possible when under load
                    new NewsletterMail(
                        $subject, 
                        $content, 
                        $buttonText, 
                        $buttonUrl
                    )
                );
                $count++;
            }
        }
    
        return $count;
    }
}
