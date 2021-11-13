<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['department_id','term_id','program_id','level','teacher_id','name'];

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function term() {
        return $this->belongsTo('App\Models\Term');
    }

    public function program() {
        return $this->belongsTo('App\Models\Program');
    }

    public function adviser() {
        return $this->belongsTo('App\Models\Teacher','teacher_id','id');
    }
}
