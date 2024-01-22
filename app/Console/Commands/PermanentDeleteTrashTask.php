<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PermanentDeleteTrashTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:permanent-delete-trash-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently Delete all trash within 30days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $trash = Task::whereNotNull('deleted_at')->get();
        foreach ($trash as $item) {
            $deleteTime  = \Carbon\Carbon::parse($item->deleted_at)->addMinutes(5);
            $now = now();
            if ($now >= $deleteTime) {
               $item->delete();
            }
        }
    }
}
