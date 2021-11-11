<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function getSummaryAttribute() {
        return $this->subjectClass->course->name
                . " " . $this->start->format('g:i A')
                . "-" .$this->end->format('g:i A')
                . " (" . $this->day . ")"
                . " " . $this->venue->name;
    }

    public static function checkVenueConflict($start, $end, $days, $venue_id) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();

        foreach($days as $day) {
            $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                $query->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
            })
            ->where('day','like',"%$day%")
            ->where('venue_id',$venue_id)
            ->whereHas('subjectClass', function($query) {
                $query->whereIn('term_id', Term::getActive()->select('id')->get());
            })
            ->first();

            if($sched) return $sched;
        }
        return null;
    }

    public static function checkSelfConflict($start, $end, $days, $subjectClassId) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();

        foreach($days as $day) {
            $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                $query->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
            })
            ->where('day','like',"%$day%")
            ->whereHas('subjectClass', function($query) use ($subjectClassId) {
                $query->where('id', $subjectClassId);
            })
            ->first();

            if($sched) return $sched;
        }
        return null;
    }

    public static function checkTeacherConflict($start, $end, $days, $teacher_id) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();

        foreach($days as $day) {
            $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                $query->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
            })
            ->where('day','like',"%$day%")
            ->whereHas('subjectClass', function($query) use ($teacher_id) {
                $query->whereIn('term_id', Term::getActive()->select('id')->get())
                        ->where('teacher_id', $teacher_id);
            })
            ->first();

            if($sched) return $sched;
        }
        return null;
    }

    public static function hasDay($day, $days) {

        foreach(explode(",", $days) as $d) {
            if($day==$d) return true;
        }

        return false;
    }
}
