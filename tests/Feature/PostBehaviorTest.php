<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Profile;
use App\Models\Post;

uses(RefreshDatabase::class);

test('allows a profile to public a post', function () {
    $profile = Profile::factory()->create();
    $post = Post::publish($profile, 'This is a test post.');

    expect($post->exists)->toBeTrue()
        ->and($post->profile->is($profile))->toBeTrue()
        ->and($post->parent_id)->toBeNull()
        ->and($post->repost_of_id)->toBeNull();

});
