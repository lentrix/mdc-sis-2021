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
}
