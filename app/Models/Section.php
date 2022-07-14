<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['department_id','term_id','program_id','level','teacher_id','name'];

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function term() {
        return $this->belongsTo('App\Models\Term');
    }

    public function program() {
        return $this->belongsTo('App\Models\Program');
    }

    public function adviser() {
        return $this->belongsTo('App\Models\Teacher','teacher_id','id');
    }

    public function classSections() {
        return $this->hasMany('App\Models\ClassSection');
    }

    public function enrolees() {
        return $this->hasMany('App\Models\Enrol');
    }

    public function getEnrolsAttribute() {
        // return $this->hasMany('App\Models\Enrol')
        //     ->with('student', function($query){
        //         $query->orderBy('last_name')->orderBy('first_name');
        //     });

        return Enrol::where('section_id', $this->id)
            ->join('students','students.id','enrols.student_id')
            ->orderBy('students.last_name')->orderBy('students.first_name')
            ->get();
    }
}
