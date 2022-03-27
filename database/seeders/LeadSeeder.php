<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        //user 1 clicks 5 offers, signs up for 1... happy path
        Lead::factory()->count(5)->create([
            'ip_hash' => md5($this->faker->ipv4),
            'user_agent_hash' => md5($this->faker->UserAgent),
            'visitor_id' => Str::random(50),
            'visit_id' => Str::random(50),
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ]);
    }
}
