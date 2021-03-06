<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['permission', 'description'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function permission() {
        return $this->belongsTo('App\Models\Permission');
    }
}
