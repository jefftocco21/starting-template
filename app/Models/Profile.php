<?php

namespace App\Models;


use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'display_name',
        'handle',
        'bio',
        'avatar_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function topLevelPosts() : HasMany
    {
        return $this->hasMany(Post::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function followers() :belongsToMany
    {
        return $this->belongsToMany(Profile::class, 'follows', 'following_profile_id', 'follower_profile_id');
    }

    public function followings() :belongsToMany
    {
        return $this->belongsToMany(Profile::class, 'follows', 'follower_profile_id', 'following_profile_id');
    }

}
