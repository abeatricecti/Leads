<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $offer = rand(100,500);

        return [
            'attribution_key' => Str::random(50),
            'ip_hash' => md5($this->faker->ipv4),
            'user_agent_hash' => md5($this->faker->UserAgent),
            'pixel_path' => "/p/{$offer}/LEADID.png",
            'visitor_id' => Str::random(50),
            'visit_id' => Str::random(50),
            'redirected_at' => (string) time() - rand(120,7000),
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
            'offer_id' => $offer
        ];
    }
}
