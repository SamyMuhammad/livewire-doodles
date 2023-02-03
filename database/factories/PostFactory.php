<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        Storage::disk('public')->makeDirectory('uploads/posts');
        return [
            'title' => fake()->sentence(3),
            'content' => fake()->text(),
            'photo' => 'storage/uploads/posts/'.fake()->image(storage_path('app/public/uploads/posts'), 640, 480, '', false),
        ];
    }
}
