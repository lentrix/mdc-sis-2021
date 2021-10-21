<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'level', 'degree','school','address','year','remarks'
    ];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }
}
