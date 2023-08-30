<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function QuestionPaper()
    {
        return view('user.exam.question_paper');
    }
}
