<?php

namespace App\Console\Commands;

use App\Models\ClassSection;
use App\Models\Schedule;
use App\Models\User;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Console\Command;

class Check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check {sectionId} {day}';

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
        $sectionId = $this->argument('sectionId');
        $day = $this->argument('day');

        $scheds = Schedule::whereIn('subject_class_id', ClassSection::where('section_id',$sectionId)->pluck('subject_class_id'))
            ->where(function($q1){
                $q1->whereBetween('start',['9:00','10:29'])
                ->orWhereBetween('end',['9:01', '10:30']);
            })
            ->where(function($q2) use ($day) {
                foreach(explode(",", $day) as $oneDay) {
                    $q2->orWhere('day','like',"%$oneDay%");
                }
            })
            ->get();

        dd($scheds);
    }
}
