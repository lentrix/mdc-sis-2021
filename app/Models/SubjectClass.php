<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','teacher_id','pay_units','limit', 'credit_units','term_id','department_id','created_by','updated_by'];

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
