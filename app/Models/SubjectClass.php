<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_no',
        'description',
        'teacher_id',
        'pay_units',
        'limit',
        'credit_units',
        'term_id',
        'department_id',
        'created_by',
        'updated_by'];

    protected $appends = ['scheduleString'];

    public function schedules() {
        return $this->hasMany('App\Models\Schedule');
    }

    public function teacher() {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function course() {
        return $this->belongsTo('App\Models\Course');
    }

    public function term() {
        return $this->belongsTo('App\Models\Term');
    }

    public function section() {
        return $this->hasOne('App\Models\ClassSection');
    }

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function enrolSubjects() {
        return $this->hasMany('App\Models\EnrolSubject');
    }

    public function getClassListAttribute() {
        return Enrol::whereHas('enrolSubjects', function($query){
            $query->where('subject_class_id', $this->id);
        })->join('students','students.id','enrols.student_id')
        ->orderBy('students.last_name')->orderBy('students.first_name')
        ->get();
    }

    public function getScheduleStringAttribute() {
        $str = "";

        foreach($this->schedules as $sched) {
            $str .= $sched->summary . " ";
        }

        return $str;
    }

    public function classSections() {
        return $this->hasMany('App\Models\ClassSection');
    }

    public static function enrollable() {
        return SubjectClass::whereIn('term_id', Term::getEnrolling()->select("id")->get())
            ->with('course', function($query) {
                $query->orderBy('name');
            });
    }
}
