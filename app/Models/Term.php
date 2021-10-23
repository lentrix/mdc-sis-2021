<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
