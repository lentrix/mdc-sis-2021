<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrol extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'program_id','section_id', 'term_id', 'level','created_by','updated_by','withdrawn','withdrawn_by','withdrawn_at','restored_by','restored_at'];

    protected $casts = [
        'withdrawn_at' => 'datetime'
    ];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function program() {
        return $this->belongsTo('App\Models\Program');
    }

    public function updatedBy() {
        return $this->belongsTo('App\Models\User','updated_by','id');
    }

    public function createdBy() {
        return $this->belongsTo('App\Models\User','created_by','id');
    }

    public function term() {
        return $this->belongsTo('App\Models\Term');
    }

    public function section() {
        return $this->belongsTo('App\Models\Section');
    }

    public function enrolSubjects() {
        return $this->hasMany('App\Models\EnrolSubject');
    }

    public function withdrawnSubjects() {
        return $this->hasMany('App\Models\WithdrawnSubject');
    }

    public function withdrawnBy() {
        return $this->belongsTo('App\Models\User', 'withdrawn_by','id');
    }

}
