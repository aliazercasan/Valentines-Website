<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_text',
        'share_slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($message) {
            if (empty($message->share_slug)) {
                $message->share_slug = Str::random(10);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
