<?php

namespace App\Console\Commands;

use App\Services\ImportProduct\EndorPhone\ImportService;
use Illuminate\Console\Command;

class ImportProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $start = microtime(true);

        $s = new ImportService();
        $s->run();
        $time = microtime(true) - $start;
        $this->info($time);

    }
}

