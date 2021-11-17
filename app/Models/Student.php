<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number','id_extension','lrn','last_name','first_name','middle_name','sex',
        'birth_date','civil_status','religion','street','barangay','town','province',
        'nationality','phone','father','occupation_father','mother','occupation_mother',
        'parents_address',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function educationalBackgrounds() {
        return $this->hasMany('App\Models\EducationalBackground')->orderBy('year','desc');
    }

    public function getFullNameAttribute() {
        return "$this->last_name, $this->first_name $this->middle_name";
    }

    public function getFullAddressAttribute() {
        $street = $this->street ? $this->street . ", " : "";
        return "$street $this->barangay, $this->town, $this->province";
    }

    public function getProfilePicAttribute() {
        $path = "img/student-pics/$this->id.jpg";
        $file = public_path($path);
        if(file_exists($file)) {
            return asset($path);
        }else {
            return asset('img/student-pics/stud-no-pic.jpg');
        }
    }

    public function currentEnrollment() {
        return Enrol::where('student_id', $this->id)
            ->whereIn('term_id', Term::getActive()->select('id')->get())
            ->first();
    }
}
