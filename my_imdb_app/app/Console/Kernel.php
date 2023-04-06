<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyYTM2ODVkNTU5ZGMwZWNmNDYyNWRmNTc1MmJlOGZkYyIsInN1YiI6IjY0MmU4NzAzYzlkYmY5MDBkNTBjZmI2NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.8_yxcR6sHOfEfbzzi4djWG6d0GSpv6pc01bm8fQ-Woo';

        // $schedule->command('inspire')->hourly();
        //$schedule->call('App\Http\Controllers\MovieController@updateDatabase')->everyMinute();

        $schedule->call(function () {
            DB::table('genres')->delete();
        })->daily();
        $schedule->call(function () {
            DB::table('directors')->delete();
        })->daily();
        $schedule->call(function () {
            DB::table('movies')->delete();
        })->daily();

        /**
         * Here will be the daily updates of the tables based on the tmdb api
         *
        */
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
