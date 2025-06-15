<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use Illuminate\View\View;

class LearnerProgressController extends Controller
{
    public function index(): View
    {
        $learners = Learner::simplePaginate(25);
        return view('learner-progress',['learners'=>$learners]);
    }
}
