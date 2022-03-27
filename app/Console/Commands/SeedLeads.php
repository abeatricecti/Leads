<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedLeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:leads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seed leads';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dump("here");
        return 0;
    }
}
