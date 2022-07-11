<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = ['term_id','name','start','end'];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];

    public function term() {
        return $this->belongsTo('App\Models\Term');
    }

    public function isActive() {
        return Carbon::now()->isBetween($this->start, $this->end);
    }
}
