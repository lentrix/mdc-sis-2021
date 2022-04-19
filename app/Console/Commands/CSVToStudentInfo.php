<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Illuminate\Support\Carbon;

class CSVToStudentInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csvtostud {filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load CSV source into students table';

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
        $path = $this->argument('filepath');
        
        if(!file_exists($path)) {
            echo "File not found.";
            return 1;
        }

        $students = json_decode(file_get_contents($path), true);

        foreach($students as $source) {
            $stud = Student::where('id_number', $source['idnum'])
                ->first();

            if(!$stud) {
                try {

                    $stud = Student::create([
                        'id_number' => $source['idnum'],
                        'id_extension' => $source['idext'],
                        'lrn' => '-',
                        'last_name' => $source['lname'],
                        'first_name' => $source['fname'],
                        'middle_name' => $source['mi'],
                        'sex' => $source['gender'],
                        'birth_date' => $source['bdate']=='0000-00-00' ? null : $source['bdate'],
                        'civil_status' => $source['status'],
                        'barangay' => $source['addb'],
                        'town' => $source['addt'],
                        'province' => $source['addp'],
                        'father' => $source['father'],
                        'mother' => $source['mother'],
                        'occupation_mother' => $source['moccup'],
                        'occupation_father' => $source['foccup'],
                        'parents_address' => $source['addparents'],
                    ]);

                    echo "Created $stud->id_number $stud->last_name, $stud->first_name \n";
                }catch(QueryException $ex) {
                    echo $ex->getMessage() . "\n";
                }
            }
        }

        return 0;
    }
}
