<?php

namespace App\Jobs;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessScheduledPosts implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle()
    {
        $schedules = Schedule::where('status','pending')
            ->where('scheduled_at','<=', now())
            ->get();

        foreach ($schedules as $s) {
            // simulate posting: change status to posted
            $s->update(['status'=>'posted']);
            // also update contentIdea status
            $s->contentIdea()->update(['status'=>'approved']);

            // log or dispatch actual API integration here
            \Log::info("Simulated posting for schedule: {$s->id}");
        }
    }
}
