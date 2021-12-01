<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['short_name','full_name','department_id','program_head'];

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function sections() {
        return $this->hasMany('App\Models\Section');
    }

    public function checkLevel($level) {
        $levels_array = [];

        if($this->department->getToplevel()->accronym=="College") {
            $levels_array = config('mdc.levels.College');
        }elseif($this->department->accronym=="PRE-K") {
            $levels_array = config('mdc.levels.PRE-Elementary');
        }elseif($this->department->accronym=="ELEM"){
            $levels_array = config('mdc.levels.ELEM');
        }elseif($this->department->accronym=="JHS"){
            $levels_array = config('mdc.levels.JHS');
        }elseif($this->department->accronym=="SHS"){
            $levels_array = config('mdc.levels.SHS');
        }elseif($this->department->accronym=="GSS"){
            $levels_array = config('mdc.levels.Graduate Studies');
        }

        return array_key_exists($level, $levels_array);
    }
}
