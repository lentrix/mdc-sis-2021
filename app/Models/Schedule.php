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
        return $this->start->format('g:i A')
                . "-" .$this->end->format('g:i A')
                . " (" . $this->day . ")"
                . " " . $this->venue->name;
    }

    public static function checkSelfConflict($start, $end, $days, $class_id) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();

        foreach($days as $day) {
            $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                $query->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
            })
            ->where('day','like',"%$day%")
            ->whereHas('subjectClass', function($query) use ($class_id) {
                $query->where('id', $class_id);
            })
            ->first();

            if($sched) return $sched;
        }
        return null;
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
            ->where('venue_id', $venue_id)
            ->whereHas('subjectClass', function($query) {
                $query->whereIn('term_id', Term::getActive()->select('id')->get());
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

    public static function checkSectionConflict(Section $section, SubjectClass $subjectClass) {
        foreach($subjectClass->schedules as $oneSched) {
            $startPlus = Carbon::parse($oneSched->start)->addMinute()->toTimeString();
            $endMinus = Carbon::parse($oneSched->end)->subMinute()->toTimeString();
            $start = $oneSched->start;
            $end = $oneSched->end;

            // foreach(explode(",", $oneSched->day) as $day) {
            //     $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
            //         $query->whereBetween('start',[$start,$endMinus])
            //             ->orWhereBetween('end',[$startPlus, $end]);
            //     })
            //     ->where('day','like',"%$day%")
            //     ->whereHas('subjectClass', function($query) use ($section) {
            //         $query->whereHas('classSections', function($q2) use ($section){
            //             $q2->where('section_id', $section->id);
            //         });
            //     })
            //     ->first();

            //     if($sched) return $sched;
            // }
            $sched = static::whereIn('subject_class_id',
                    ClassSection::where('section_id',$section->id)->pluck('subject_class_id'))
                ->where(function($q1) use ($start, $startPlus, $end, $endMinus){
                    $q1->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
                })
                ->where(function($q2) use ($oneSched) {
                    foreach(explode(",", $oneSched->day) as $oneDay) {
                        $q2->orWhere('day','like',"%$oneDay%");
                    }
                })
                ->first();

            if($sched) return $sched;

        }
        return null;
    }

    public static function getSchedulesInSection(Section $section) {
        $scheds = static::whereIn('subject_class_id', ClassSection::where('section_id',$section->id)->pluck('id'))
            ->get();
        return $scheds;
    }

    public static function checkAddSchedSectionConflict($start, $end, $days, Section $section) {
        $startPlus = Carbon::parse($start)->addMinute()->toTimeString();
        $endMinus = Carbon::parse($end)->subMinute()->toTimeString();

        foreach($days as $day) {
            $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                $query->whereBetween('start',[$start,$endMinus])
                    ->orWhereBetween('end',[$startPlus, $end]);
            })
            ->where('day','like',"%$day%")
            ->whereHas('subjectClass', function($query) use ($section) {
                $query->whereHas('classSections', function($query2) use ($section) {
                    $query2->where('section_id', $section->id);
                });
            })
            ->first();

            if($sched) return $sched;
        }
    }

    public static function checkEnrolConflict(Enrol $enrol, SubjectClass $subjectClass) {
        foreach($subjectClass->schedules as $sched) {
            $startPlus = Carbon::parse($sched->start)->addMinute()->toTimeString();
            $endMinus = Carbon::parse($sched->end)->subMinute()->toTimeString();
            $start = $sched->start;
            $end = $sched->end;

            foreach(explode(",", $sched->day) as $day) {
                $sched = static::where(function($query) use ($startPlus, $endMinus, $start, $end) {
                    $query->whereBetween('start',[$start,$endMinus])
                        ->orWhereBetween('end',[$startPlus, $end]);
                })
                ->where('day','like',"%$day%")
                ->whereHas('subjectClass', function($query) use ($enrol) {
                    $query->whereHas('enrolSubjects', function($q2) use ($enrol){
                        $q2->where('enrol_id', $enrol->id);
                    });
                })
                ->first();

                if($sched) return $sched;
            }
        }
    }

    public static function hasDay($day, $days) {

        foreach(explode(",", $days) as $d) {
            if($day==$d) return true;
        }

        return false;
    }
}
