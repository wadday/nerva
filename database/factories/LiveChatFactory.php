<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LiveChat>
 */
class LiveChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->optional()->randomNumber(),
            'username' => $this->faker->userName(),
            'message' => $this->faker->sentence(),
            'track_id' => $this->faker->randomNumber(),
            'stream_id' => $this->faker->randomNumber(),
            'sent_at' => now(),
            'is_flagged' => $this->faker->boolean(),
            'is_deleted' => $this->faker->boolean(),
            'ip_address' => $this->faker->ipv4(),
            'metadata' => json_encode(['example_key' => 'example_value']),
            'gift_type' => $this->faker->randomElement(['coin', 'badge', 'star', null]),
            'gift_value' => $this->faker->randomFloat(2, 1, 100),
            'reaction_type' => $this->faker->randomElement(['like', 'fire', 'clap', null]),
        ];
    }
}
