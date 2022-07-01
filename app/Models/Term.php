<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['accronym','name','type','enrol_start','enrol_end','start','end'];

    protected $casts = [
        'enrol_start' => 'datetime',
        'enrol_end' => 'datetime',
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function periods() {
        return $this->hasMany('App\Models\Period');
    }

    public static function getActive() {
        $now = Carbon::now('Asia/Manila');
        return Term::where('enrol_start','<=', $now)
                ->where('end','>=', $now);
    }

    public static function getEnrolling() {
        $now = Carbon::now('Asia/Manila');

        return Term::where('enrol_start',"<=", $now)
                ->where('enrol_end',">=", $now);
    }

    public function getGradingNames() {
        $gradingNames = [];
        foreach($this->periods as $period) {
            $gradingNames[] = $period->name;
        }
        return implode(",", $gradingNames);
    }

    public function getPeriod($periodName) {
        return Period::where('term_id', $this->id)
            ->where('name', $periodName)
            ->first();
    }
}
