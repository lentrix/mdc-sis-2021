<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['score_column_id','enrol_subject_id','score'];

    public function scoreColumn() {
        return $this->belongsTo('App\Models\ScoreColumn');
    }

    public function enrolSubject() {
        return $this->belongsTo('App\Models\EnrolSubject');
    }
}
