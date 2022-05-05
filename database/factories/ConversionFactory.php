<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $offer = rand(100,500);
        $ip = $this->faker->ipv4;
        $user_agent = $this->faker->UserAgent;

        return [
            'attribution_key' => Str::random(50),
            'ip_address' => $ip,
            'ip_hash' => md5($ip),
            'user_agent' => $user_agent,
            'user_agent_hash' => md5($user_agent),
            'pixel_path' => "/p/{$offer}/LEADID.png",
            'visitor_id' => Str::random(50),
            'visit_id' => Str::random(50),
            'conversion_at' => (string) time() - rand(120,7000),
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];
    }
}
