<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Like;

uses(RefreshDatabase::class);

test('profile can like post', function () {
    $profile = Profile::factory()->create();
    $post = Post::factory()->create();

    $like = Like::createLike($profile, $post);

    expect($profile->likes)->toHaveCount(1)
        ->and($profile->likes->contains($like))->tobeTrue()
        ->and($post->likes)->toHaveCount(1)
        ->and($post->likes->contains($like))->toBeTrue()
        ->and($like->post->is($post))->toBeTrue()
        ->and($like->profile->is($profile))->toBeTrue();
});

test('profile cannot create duplicate likes', function () {
    $profile = Profile::factory()->create();
    $post = Post::factory()->create();

    $L1 = Like::createLike($profile, $post);
    $L2 = Like::createLike($profile, $post);

    expect($L1->id)->toEqual($L2->id);
});

test('can remove a like', function () {
    $profile = Profile::factory()->create();
    $post = Post::factory()->create();

    $like = Like::createLike($profile, $post);

    $success = Like::removeLike($profile, $post);

    expect($profile->likes)->toHaveCount(0)
        ->and($profile->likes->contains($like))->toBeFalse()
        ->and($post->likes)->toHaveCount(0)
        ->and($post->likes->contains($like))->toBeFalse()
        ->and($success)->toBeTrue();
});