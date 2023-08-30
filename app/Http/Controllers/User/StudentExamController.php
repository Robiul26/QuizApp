<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function QuestionPaper($exam_id)
    {
        $data['questions'] = Question::where('exam_id', $exam_id)->orderBy('id', 'ASC')->get();
        return view('user.exam.question_paper', $data);
    }
}
