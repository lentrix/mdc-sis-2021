<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['accronym', 'name','parent_id','head_id'];

    public function head() {
        return $this->belongsTo('App\Models\User','head_id','id');
    }

    public function parent() {
        return $this->belongsTo('App\Models\Department','parent_id','id');
    }

    public function subDepartments() {
        return $this->hasMany('App\Models\Department', 'parent_id', 'id');
    }

    public function sections() {
        return $this->hasMany('App\Models\Section');
    }

    public function getDepartmentHeadNameAttribute() {
        if($this->head_id) {
            return $this->head->fullName;
        }else{
            return "None";
        }
    }

    public static function list() {
        $depts = static::orderBy('name')->get();

        $list  = [];

        foreach($depts as $dept) {
            $list[$dept->id] = $dept->name;
        }
        return $list;
    }

    public static function headedBy(User $user) {
        return Department::where('head_id', $user->id);
    }
}
