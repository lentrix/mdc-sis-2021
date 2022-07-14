<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRecord extends Model
{
    protected $fillable = ['subject_class_id','remarks'];

    public function subjectClass() {
        return $this->belongsTo('App\Models\SubjectClass');
    }
}
