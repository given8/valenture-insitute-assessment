<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use App\Models\Course;
use App\Models\Enrolment;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class LearnerProgressController extends Controller
{
    public function index(Request $request): View
    {
        $selectedCourse = $request->input('course');
        $sortingOrder = $request->input('sort');
        $learners = Learner::when($selectedCourse, function (Builder $query, string $selectedCourse) {
            $query->whereHas('courses', function (Builder $query) use ($selectedCourse) {
                $query->where('courses.id', $selectedCourse);
            });
        })->when($sortingOrder, function (Builder $query, string $sortingOrder) {
            if ($sortingOrder == 'asc') {
                $query->with('enrolments') // Couldn't get this to work without repeating myself
                    ->orderBy(Enrolment::select(DB::raw('AVG(progress)'))
                        ->whereColumn('enrolments.learner_id', 'learners.id'));
            } else {
                $query->with('enrolments')
                    ->orderByDesc(Enrolment::select(DB::raw('AVG(progress)'))
                        ->whereColumn('enrolments.learner_id', 'learners.id'));
            }
        })->paginate(25);

        $courses = Course::all();
        return view('learner-progress', ['learners' => $learners, 'courses' => $courses, 'selectedCourse' => $selectedCourse, 'sortingOrder' => $sortingOrder]);
    }
}
