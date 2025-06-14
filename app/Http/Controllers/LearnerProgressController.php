<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use Illuminate\View\View;

class LearnerProgressController extends Controller
{
    public function index(): View
    {
        $learners = Learner::all();
        return view('learner-progress',['learners'=>$learners]);
    }
}
