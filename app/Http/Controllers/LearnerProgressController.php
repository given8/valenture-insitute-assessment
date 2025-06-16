<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use App\Models\Course;
use App\Models\Enrolment;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LearnerProgressController extends Controller
{
    public function index(Request $request): View
    {
        $selectedCourse = $request->input('course');
        $sortingOrder = $request->input('sort');
        if(isset($selectedCourse)){
            error_log('Some message here.');
        }
        error_log("AVG(progress) " . $sortingOrder);
        $learners = Learner::when($selectedCourse, function(Builder $query, string $selectedCourse){
            $query->whereHas('courses',function(Builder $query) use ($selectedCourse){
                $query->where('courses.id',$selectedCourse);
            });
        })->when($sortingOrder, function(Builder $query, string $sortingOrder){
            $query->with('enrolments')
        ->orderBy(Enrolment::select(DB::raw('AVG(progress)'))
        ->whereColumn('enrolments.learner_id','learners.id'));
        })->paginate(25);
        // $learners=Learner::with('enrolments')
        // ->orderBy(Enrolment::select(DB::raw('AVG(progress)'))
        // ->whereColumn('enrolments.learner_id','learners.id'))
        // ->paginate(25);
        // dd($learners);
        $courses = Course::all();
        return view('learner-progress', ['learners' => $learners, 'courses' => $courses]);
    }
}
