<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\Admin\ImportProductNotification;
use App\Services\ImportProduct\TimeOfStyle\ImportProductService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $s = new ImportProductService();
        $s->run();
        $user = User::find(1);

        $user->notify(new ImportProductNotification());
    }
}
