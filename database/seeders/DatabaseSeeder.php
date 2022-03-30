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
    public function __construct(Lead $lead)
    {
        $this->faker = Faker::create();
    }

    private function arrWithout($arr, $list) {
        return array_filter($arr, fn ($k) => !in_array($k, $list), ARRAY_FILTER_USE_KEY);
    }

    //user 1 clicks 3 offers, signs up for 1 - everything matches: ip,useragent,cookies,geo
    private function createUserOne() {
        $user = User::factory()->create();
        $leads = Lead::factory()->count(3)->create([
            'ip_hash' => $user->ip_hash,
            'user_agent_hash' => $user->user_agent_hash,
            'visitor_id' => $user->visitor_id,
            'visit_id' => $user->visit_id,
            'city' => $user->city,
            'state' => $user->state,
            'zip' => $user->zip,
        ]);

        $lead = $this->arrWithout($leads[0]->toArray(), ['updated_at', 'created_at', 'id']);

        $lead['conversion_at'] = $lead['redirected_at'] + 240;
        $conversion = $this->arrWithout($lead, ['redirected_at', 'offer_id']);
        Conversion::create($conversion);
    }

    //user 2 clicks 3 offers with cookies disabled and signs up for 1 offer.
    //maches: ip, geo, user-agent; changes/dont have: attribution_key, visitor_id, visit_id
    private function createUserTwo() {
        $user = User::factory()->create();
        $leads = Lead::factory()->count(3)->create([
            'ip_hash' => $user->ip_hash,
            'user_agent_hash' => $user->user_agent_hash,
            'city' => $user->city,
            'state' => $user->state,
            'zip' => $user->zip,
        ]);

        $conversion = $leads[0]->toArray();
        $conversion['conversion_at'] = $conversion['redirected_at'] + 300;
        Conversion::create($this->arrWithout($conversion, [
            'redirected_at', 'offer_id', 'updated_at', 'created_at', 'id',
            'attribution_key', 'visitor_id', 'visit_id'
        ]));
    }

    //user 3 clicks 3 offers, connects to a vpn changing their ip address, and signs up for 1 offer
    //maches: geo, user-agent, attribution_key, visitor_id, visit_id; changes/dont have: ip 
    private function createUserThree() {
        $user = User::factory()->create();
        $leads = Lead::factory()->count(3)->create([
            'ip_hash' => $user->ip_hash,
            'user_agent_hash' => $user->user_agent_hash,
            'city' => $user->city,
            'state' => $user->state,
            'zip' => $user->zip,
        ]);

        //generate some noise with other leads that match user agent but diff geo
        $leads = Lead::factory()->count(3)->create([
            'user_agent_hash' => $user->user_agent_hash,
        ]);

        $conversion = $leads[0]->toArray();
        $conversion['conversion_at'] = $conversion['redirected_at'] + 250;
        Conversion::factory()->create($this->arrWithout($conversion, [
            'redirected_at', 'offer_id', 'updated_at', 'created_at', 'id',
            'attribution_key', 'visitor_id', 'visit_id', 'ip_hash'
        ]));
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->createUserOne();
        // $this->createUserTwo();
        $this->createUserThree();
    }
}
