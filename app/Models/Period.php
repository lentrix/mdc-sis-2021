<?php

namespace App\Models;

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
}
