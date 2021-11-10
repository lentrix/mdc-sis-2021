<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    protected $fillable = ['day','start','end','venue_id','subject_class_id'];

    public function subjectClass() {
        return $this->belongsTo('App\Models\SubjectClass');
    }

    public function venue() {
        return $this->belongsTo('App\Models\Venue');
    }
}
