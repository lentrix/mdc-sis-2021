<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check';

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
     * @return int
     */
    public function handle()
    {
        foreach(User::get() as $usr) {
            echo  $usr->user . " - " . ($usr->isOnly('student') ? "yes " : "no ");
        }
        return Command::SUCCESS;
    }
}
