<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    use HasFactory;

    protected $fillable = ['subject_class_id','section_id','user_id'];

    public function section() {
        return $this->belongsTo('App\Models\Section');
    }

    public function subjectClass() {
        return $this->belongsTo('App\Models\SubjectClass');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
