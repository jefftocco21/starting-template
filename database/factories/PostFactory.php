<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profile_id' => Profile::factory(),
            'parent_id' => null,
            'repost_of_id' => null,
            'content' => $this->faker->realText(200),
        ];
    }
    
    public function quotePost(Post $originalPost)
    {
        return $this->state([
            'content' => $this->faker->realText(200),
            'repost_of_id' => $originalPost->id,
        ]);
    }

    public function reply(Post $parentPost)
    {
        return $this->state([
            'content' => $this->faker->realText(200),
            'parent_id' => $parentPost->id,
        ]);
    }


}
