<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class MakeAvailableRoom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-available-room';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Testing of Cron Job Successfull.");
    }
}
