<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrol extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'program_id','level','created_by','updated_by'];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function program() {
        return $this->belongsTo('App\Models\Program');
    }

    public function updatedBy() {
        return $this->belongsTo('App\Models\User','updated_by','id');
    }

    public function createdBy() {
        return $this->belongsTo('App\Models\User','created_by','id');
    }
}