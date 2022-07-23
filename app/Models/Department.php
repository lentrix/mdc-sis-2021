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

    public function teachers() {
        return $this->hasMany('App\Models\Teacher');
    }

    public function allTeachers() {
        return Teacher::whereIn('department_id', explode(",", $this->getHierarchyList()));
    }

    public function allStudents() {
        return Enrol::whereHas('program', function($query){
            $query->whereIn('department_id', explode(",", $this->getHierarchyList()));
        })->with('students')->orderBy('last_name')->orderBy('first_name');
    }

    public static function list() {
        $depts = static::orderBy('name')->get();

        $list  = [];

        foreach($depts as $dept) {
            $list[$dept->id] = $dept->name;
        }
        return $list;
    }

    public function heads() {
        return $this->hasMany('App\Models\Head');
    }

    public static function headedBy(User $user) {
        return Department::whereHas('heads', function($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function isHeadedBy(User $user) {
        foreach($this->heads as $head) {
            if($head->user_id === $user->id) return $head;
        }
        return null;
    }

    public function getTopLevel() {
        if($this->parent) {
            return $this->parent->getTopLevel();
        }

        return $this;
    }

    public function getHierarchyList($str="") {

        if($this->subDepartments->count()>0) {
            foreach($this->subDepartments as $sub) {
                $str .= $sub->getHierarchyList();
            }
        }

        return $str . "$this->id,";
    }

    public function getTeacherCountAttribute() {
        return $this->teachers->count();
    }
}
