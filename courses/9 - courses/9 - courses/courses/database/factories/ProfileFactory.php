<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'biography' => fake()->paragraphs(2, true),
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode(fake()->name()) . '&background=random&color=fff',
            'website' => fake()->url(),
        ];
    }
}