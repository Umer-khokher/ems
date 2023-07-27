<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\User;
class MarkAbsentCommand extends Command
{
    protected $signature = 'attendance:mark-absent';
    protected $description = 'Mark absent users in the attendance system.';

    public function handle()
    {
        $now = now();
        $checkInTimeStart = $now->copy()->setHour(9)->setMinute(0)->setSecond(0);
        $checkInTimeEnd = $now->copy()->setHour(10)->setMinute(30)->setSecond(0);

        // Fetch users who haven't checked in between 9:00 AM and 10:30 AM
        $absentUsers = User::whereDoesntHave('attendances', function ($query) use ($checkInTimeStart, $checkInTimeEnd) {
            $query->whereBetween('created_at', [$checkInTimeStart, $checkInTimeEnd]);
        })->get();

        // Mark absent users in the attendance table
        foreach ($absentUsers as $user) {
            Attendance::create([
                'user_id' => $user->id,
                'status' => 'absent',
                'created_at' => now(),
            ]);
        }

        $this->info('Absent users have been marked in the attendance system.');
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    // public function handle()
    // {
    //     return 0;
    // }
}
