<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number','id_extension','lrn','last_name','first_name','sex',
        'birth_date','civil_status','religion','street','barangay','town','province',
        'nationality','phone','father','occupation_father','mother','occupation_mother',
        'parents_address',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function educationalBackgrounds() {
        return $this->hasMany('App\Models\EducationalBackground');
    }
}
