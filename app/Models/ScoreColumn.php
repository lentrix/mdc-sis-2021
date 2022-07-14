<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreColumn extends Model
{
    protected $fillable = ['period_id', 'class_record_id', 'name','weight','total','remarks'];

    public function period() {
        return $this->belongsTo('App\Models\Period');
    }

    public function classRecord() {
        return $this->belongsTo('App\Models\ClassRecord');
    }

}
