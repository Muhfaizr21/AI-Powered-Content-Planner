<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessScheduledPosts;

class RunScheduledPosts extends Command
{
    protected $signature = 'posts:run';
    protected $description = 'Process scheduled posts';

    public function handle()
    {
        ProcessScheduledPosts::dispatch();
        $this->info('Dispatched processing job.');
    }
}
