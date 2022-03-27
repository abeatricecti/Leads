<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\User;
use App\Models\Conversion;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        //user 1 clicks 3 offers, signs up for 1 - everything matches: ip,useragent,cookies,geo
        $user1 = User::factory()->create();

        $user1Leads = Lead::factory()->count(3)->create([
            'ip_hash' => $user1->ip_hash,
            'user_agent_hash' => $user1->user_agent_hash,
            'visitor_id' => $user1->visitor_id,
            'visit_id' => $user1->visit_id,
            'city' => $user1->city,
            'state' => $user1->state,
            'zip' => $user1->zip,
        ]);

        $lead = array_filter($user1Leads[2]->toArray(), function($k) {
            return !in_array($k, ['updated_at', 'created_at', 'id']);
        }, ARRAY_FILTER_USE_KEY);

        $lead['conversion_at'] = $lead['redirected_at'] + 240;
        unset($lead['redirected_at']);
        Conversion::create($lead);

        //user 2 clicks 3 offers, changes computers in house, signs up for 1 offer. maches: ip, geo; changes: user-agent, visitor_id, visit_id
    }
}
