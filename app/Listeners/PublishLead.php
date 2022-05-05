<?php

namespace App\Listeners;

use App\Events\LeadSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class PublishLead
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LeadSaved  $event
     * @return void
     */
    public function handle(LeadSaved $event)
    {
        $lead = array_filter($event->lead->toArray(), function($k) {
            return !in_array($k, ['updated_at', 'created_at', 'id']);
        }, ARRAY_FILTER_USE_KEY);
        $lead['redirected_at'] = (string) $lead['redirected_at'];
        $lead = collect($lead)->toJson();
        $lead = base64_encode($lead);

        
        $url = "https://stage-products.gobankingrates.com/offer-redirects";
        Http::post($url, ['enc' => $lead]);
    }
}
