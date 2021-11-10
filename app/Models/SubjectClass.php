<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;

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
}
