<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','credit','requisite','department_id','program_id'];

    public function requisite() {
        return $this->belongsTo('App\Models\Course','requisite_course','id');
    }

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function program() {
        return $this->belongsTo('App\Models\Program');
    }

    public function getFullIdentityAttribute() {
        return "[$this->name] $this->description";
    }
}
