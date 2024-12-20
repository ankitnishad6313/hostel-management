<?php

namespace App\Console\Commands;

use App\Models\Bed;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Console\Command;
use Log;
use Storage;

class MakeAvailableBed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-available-bed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs Every minute and make free beds based on Boarding Status.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::where('boarding_status', 'pending')
            ->orWhere('boarding_status', 'onboarding')
            ->where('check_out_date', "<=", now())
            ->get();

        foreach ($bookings as $data) {
            Bed::find($data->bed_id)->update(['bed_status' => 'available']);
            Room::find($data->room_id)->update(['room_status' => 'available']);
            Log::info("Room Id: $data->room_id and Bed Id: $data->bed_id is now Available!!");
        }
    }
}
