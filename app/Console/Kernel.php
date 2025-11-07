<?php
protected function schedule(Schedule $schedule)
{
    $schedule->command('posts:run')->everyMinute();
}
