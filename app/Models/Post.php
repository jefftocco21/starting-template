<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'parent_id',
        'content',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function replies() :HasMany 
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function likes() :HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function repost() :HasMany
    {
        return $this->hasMany(Post::class, 'repost_of_id');
    }

    public static function publish(Profile $profile, string $content) :self
    {
        return static::create([
            'profile_id' => $profile->id,
            'content' => $content,
            'parent_id' => null,
            'repost_of_id' => null,
        ]);
    }
}
