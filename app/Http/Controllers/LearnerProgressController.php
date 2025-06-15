<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use App\Models\Course;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class LearnerProgressController extends Controller
{
    public function index(Request $request): View
    {
        $selectedCourse = $request->input('course');
        // $learners = DB::table('learners')
        //     ->join('enrolments','learners.id','=','enrolments.learner_id')
        //     ->join('courses','enrolments.course_id','=','courses.id')
        //     ->select('firstname','lastname','courses.name','enrolments.progress')
        //     ->groupBy('firstname','lastname')
        //     ->when($selectedCourse, function (Builder $query, string $selectedCourse) {
        //         $query->whereHas('enrolments', function (Builder $query) {
        //             $query->where('course_id', '=', $selectedCourse);
        //         })->get();
        //     })->get();
        $learners = Learner::when($selectedCourse, function(Builder $query, string $selectedCourse){
            $query->whereHas('courses',function(Builder $query) use ($selectedCourse){
                $query->where('courses.id',$selectedCourse);
            });
        })->simplePaginate(25);
        $courses = Course::all();
        echo $learners;
        return view('learner-progress', ['learners' => $learners, 'courses' => $courses]);
    }
}
