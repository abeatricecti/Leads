<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ip = $this->faker->ipv4;
        $user_agent = $this->faker->UserAgent;

        return [
            'ip_address' => $ip,
            'ip_hash' => md5($ip),
            'user_agent' => $user_agent,
            'user_agent_hash' => md5($user_agent),
            'visitor_id' => Str::random(50),
            'visit_id' => Str::random(50),
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];
    }
}
