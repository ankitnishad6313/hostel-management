<?php

namespace App\Console\Commands;

use App\Models\Assignment;
use App\Models\Hostel;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckHostelPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-hostel-package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run every day in midnight to check and update Hostel Package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $assignments = Assignment::where('end_date', "<=", now())->get();

        foreach ($assignments as $item) {
            $hostel = Hostel::find($item->hostel_id);
            $hostel->package_id = 6;
            $hostel->hostel_membership = "FREE";
            $hostel->save();

            $item->end_date = Carbon::now()->addDays(365);
            $item->save();
        }
    }
}
