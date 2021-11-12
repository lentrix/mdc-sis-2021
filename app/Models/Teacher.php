<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','specialization','phone','department_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function advisory() {
        return $this->hasMany('App\Models\Section')->whereIn('term_id', Term::getActive()->select('id')->get());
    }
}
