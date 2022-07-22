<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassRecordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrolController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PrintablesController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectClassController;
use App\Http\Controllers\TeacherClassesController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::resource('/','Controller');

Route::get('/phpinfo',function(){
    return phpinfo();
});

Route::get('/', [SiteController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware'=>'auth'], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard',[SiteController::class, 'dashboard']);

    Route::get('/users/profile', [UserController::class,'profile']);
    Route::post('/users/profile', [UserController::class,'update']);
    Route::get('/users/change-password', [UserController::class, 'changePasswordForm']);
    Route::post('/users/change-password', [UserController::class, 'changePassword']);

    Route::get('/departments/{department}',[DepartmentController::class,'show']);
    Route::get('/departments',[DepartmentController::class,'index']);

    Route::get('/user-mgt/{user}', [UserManagementController::class, 'show']);
    Route::get('/user-mgt', [UserManagementController::class, 'index']);
    Route::post('/user-mgt/roles', [UserManagementController::class, 'addRole']);
    Route::delete('/user-mgt/{user}/roles', [UserManagementController::class, 'deleteRole']);
    Route::post('/user-mgt/permissions', [UserManagementController::class, 'addPermission']);
    Route::post('/user-mgt/users', [UserManagementController::class, 'addUser']);
    Route::put('/user-mgt/users/{user}', [UserManagementController::class, 'updateUser']);
    Route::patch('/user-mgt/users/{user}', [UserManagementController::class, 'changePassword']);
    Route::post('/user-mgt/toggle-activation/{user}', [UserManagementController::class, 'toggleUserActivation']);

    Route::get('/roles', [RolesController::class, 'index']);
    Route::post('/roles', [RolesController::class, 'store']);
    Route::put('/roles', [RolesController::class, 'update']);
    Route::delete('/roles', [RolesController::class, 'destroy']);

    Route::get('/permissions', [PermissionsController::class, 'index']);
    Route::post('/permissions', [PermissionsController::class, 'store']);
    Route::put('/permissions', [PermissionsController::class, 'update']);
    Route::delete('/permissions', [PermissionsController::class, 'destroy']);

    Route::put('/departments/{department}', [DepartmentController::class, 'update']);
    Route::post('/departments',[DepartmentController::class,'store']);

    Route::post('/heads/{department}',[HeadController::class, 'store']);
    Route::delete('/heads/{head}',[HeadController::class, 'destroy']);

    Route::get('/terms',[TermsController::class,'index']);
    Route::post('/terms',[TermsController::class,'store']);
    Route::get('/terms/{term}', [TermsController::class, 'show']);
    Route::put('/terms/{term}', [TermsController::class, 'update']);

    Route::post('/periods', [PeriodController::class, 'store']);
    Route::put('/periods', [PeriodController::class, 'update']);
    Route::delete('/periods', [PeriodController::class,'destroy']);

    Route::post('/venues', [VenueController::class, 'store']);
    Route::get('/venues', [VenueController::class, 'index']);
    Route::put('/venues/{venue}', [VenueController::class, 'update']);
    Route::get('/venues/{venue}', [VenueController::class, 'show']);

    Route::get('/programs/create', [ProgramController::class, 'create']);
    Route::get('/programs/search', [ProgramController::class, 'search']);
    Route::delete('/programs/{program}',[ProgramController::class, 'destroy']);
    Route::get('/programs/{program}', [ProgramController::class, 'show']);
    Route::put('/programs/{program}', [ProgramController::class, 'update']);
    Route::post('/programs', [ProgramController::class, 'store']);

    Route::get('/courses/create', [CourseController::class,'create']);
    Route::get('/courses/search', [CourseController::class, 'search']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);

    Route::get('/classes/create', [SubjectClassController::class, 'create']);
    Route::get('/classes/{class}/edit', [SubjectClassController::class, 'edit']);
    Route::delete('/classes/{class}/remove-sched', [SubjectClassController::class, 'removeSched']);
    Route::post('/classes/{class}/add-sched', [SubjectClassController::class, 'addSched']);
    Route::patch('/classes/update-sched/{schedule}', [SubjectClassController::class, 'updateSched']);
    Route::put('/classes/{class}', [SubjectClassController::class, 'update']);
    Route::get('/classes/{class}', [SubjectClassController::class, 'show']);
    Route::post('/classes', [SubjectClassController::class, 'store']);
    Route::get('/classes', [SubjectClassController::class, 'index']);

    Route::post('/sections/{section}/add-class', [SectionController::class, 'addSubjectClass']);
    Route::delete('/sections/{section}/remove-class', [SectionController::class, 'removeSubjectClass']);
    Route::put('/sections/{section}', [SectionController::class, 'update']);
    Route::get('/sections/{section}', [SectionController::class, 'show']);
    Route::get('/sections', [SectionController::class, 'index']);
    Route::post('/sections', [SectionController::class, 'store']);

    Route::get('/enrols/edit/{enrol}', [EnrolController::class, 'edit']);
    Route::patch('/enrols/remove-class/{enrol}', [EnrolController::class, 'removeClass']);

    Route::get('/students/search', [StudentController::class, 'search']);
    Route::get('/students/create', [StudentController::class, 'create']);
    Route::post('/students', [StudentController::class,'store']);
    Route::post('/students/educational-backgrounds/{student}', [StudentController::class, 'addEducationalBackground']);
    Route::put('/students/educational-backgrounds/{student}', [StudentController::class, 'updateEducationalBackground']);
    Route::get('/students/edit/{student}', [StudentController::class,'edit']);
    Route::get('/students/{student}', [StudentController::class,'show']);
    Route::put('/students/{student}', [StudentController::class,'update']);

    Route::get('/enrols/current/{student}', [EnrolController::class, 'current']);
    Route::get('/enrols/history/{student}', [EnrolController::class, 'history']);
    Route::post('/enrols/create/{student}', [EnrolController::class, 'create']);
    Route::post('/enrols/sectioned/{student}', [EnrolController::class, 'enrolToSection']);
    Route::patch('/enrols/attach-section/{enrol}', [EnrolController::class, 'attachSection']);
    Route::patch('/enrols/detach-section/{enrol}', [EnrolController::class, 'detachSection']);
    Route::patch('/enrols/add-class-by-serial/{enrol}', [EnrolController::class, 'addBySerial']);
    Route::patch('/enrols/withdraw/{enrol}', [EnrolController::class, 'withdrawEnrollment']);
    Route::patch('/enrols/restore/{enrol}', [EnrolController::class, 'restoreEnrollment']);
    Route::get('/enrols/{enrol}', [EnrolController::class, 'show']);
    Route::put('/enrols/edit/{enrol}', [EnrolController::class, 'update']);
    Route::post('/enrols/{student}', [EnrolController::class, 'store']);
    Route::get('/enrols', [EnrolController::class, 'search']);

    Route::get('/teacher-classes/{subjectClass}/create-class-record',[ClassRecordController::class, 'createClassRecord']);
    Route::get('/teacher-classes/{subjectClass}/class-record',[ClassRecordController::class, 'showClassRecord']);
    Route::post('/teacher-classes/{subjectClass}/class-record/add-column',[ClassRecordController::class, 'addColumn']);
    Route::get('/teacher-classes', [TeacherClassesController::class,'index']);
    Route::get('/teacher-classes/{subjectClass}', [TeacherClassesController::class, 'show']);
    Route::get('/teacher-classes/{subjectClass}/grading', [TeacherClassesController::class, 'grading']);
    Route::patch('/teacher-classes/{subjectClass}/grading-config', [TeacherClassesController::class, 'setConfiguration']);
    Route::put('/teacher-classes/{subjectClass}/set-grade/{col}', [TeacherClassesController::class, 'setGrade']);
    Route::get('/teachers/search', [TeacherController::class, 'search']);
    Route::get('/teachers/create', [TeacherController::class,'create']);
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update']);
    Route::post('/teachers', [TeacherController::class, 'store']);

    Route::get('/pdf/class-list/{subjectClass}', [PrintablesController::class, 'classList']);
    Route::get('/pdf/teaching-load/{teacher}', [PrintablesController::class, 'teachingLoad']);
    Route::get('/pdf/study-load/{enrol}', [PrintablesController::class, 'studyLoad']);
    Route::get('/pdf/section-list/{section}', [PrintablesController::class, 'sectionList']);

    Route::get('/reports/student-list', [ReportsController::class, 'studentList']);
    Route::post('/reports/student-list', [ReportsController::class, 'studentList']);
    Route::get('/reports/enrollment-list', [ReportsController::class, 'enrollmentList']);
    Route::get('/reports/promotional-report', [ReportsController::class, 'promotionalReport']);
});

