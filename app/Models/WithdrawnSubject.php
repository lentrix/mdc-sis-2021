<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawnSubject extends Model
{
    protected $fillable = ['enrol_id','subject_class_id'];

    public function enrol() {
        return $this->belongsTo('App\Models\Enrol');
    }

    public function subjectClass() {
        return $this->belongsTo('App\Models\SubjectClass');
    }


}
