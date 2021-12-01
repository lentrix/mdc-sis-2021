<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolSubject extends Model
{
    use HasFactory;

    protected $fillable = ['enrol_id','subject_class_id','created_by'];

    public function enrol() {
        return $this->belongsTo('App\Models\Enrol');
    }

    public function subjectClass() {
        return $this->belongsTo('App\Models\SubjectClass');
    }

    public function createdBy() {
        return $this->belongsTo('App\Models\User','created_by','id');
    }
}
