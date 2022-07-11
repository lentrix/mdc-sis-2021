<?php

namespace App\Console\Commands;

use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;

class CSVToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csvtouser {filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load a csv file to users table';

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

        $file = fopen($path, "r");

        while($row = fgetcsv($file)) {
            $this->insertUser($row);
        }

        return 0;
    }

    private function getDepartmentID($deptName) {
        $dept = Department::where('accronym',$deptName)->first();

        if(!$dept) {
            echo "Department not found: " . $deptName . "\n";
            return 1;
        }

        return $dept->id;
    }

    private function insertUser($data) {
        $user = User::where('lname', $data[2])
                ->where('fname', $data[3])
                ->first();

        if($user) {
            return;
        }

        $user = User::create([
            'user' => $data[1],
            'lname' => $data[2],
            'fname' => $data[3],
            'email' => $data[4],
            'password' => bcrypt(substr($data[2],0,3) . "_" . substr($data[3],0,3))
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'name' => $user->fname . " " . $user->lname,
            'short_name' => substr($user->fname,0,1) . ". " . $user->lname,
            'specialization' => $data[5],
            'phone' => $data[6],
            'department_id' => $this->getDepartmentID($data[7])
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 3
        ]);

        echo "User " . $user->fullName . " created.\n";
    }
}
