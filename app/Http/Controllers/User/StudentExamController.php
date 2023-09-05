<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\StudentAssignExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class StudentExamController extends Controller
{
    public function QuestionPaper($exam_id)
    {
        $assign_check = StudentAssignExam::where('user_id', Auth::user()->id)->where('exam_id', $exam_id)->count();
        if ($assign_check) {
            $left_time = Exam::where('id', $exam_id)->first()->left_time;

            session()->put('left_time', $left_time);

            $data['results'] = StudentAnswer::where('user_id', Auth::user()->id)->where('exam_id', $exam_id)->get();
            if (count($data['results']) > 0) {
                $data['total_correct'] = 0;
                $data['taken_exam'] = 'You have already taken this exam!!';
                $data['questions'] = Question::with('result')->where('exam_id', $exam_id)->get();
                foreach ($data['questions'] as $question) {
                    if ($question->question_answer == @$question->result->answer) {
                        $data['total_correct']++;
                    }
                }
                return view('user.exam.result_view', $data);
            } else {
                $data['exam_id'] = $exam_id;
                $data['questions'] = Question::where('exam_id', $exam_id)->orderBy('id', 'ASC')->get();
                return view('user.exam.question_paper', $data);
            }
        } else {
            echo 'You are not assign this Exam';
        }
    }

    public function AnswerStore(Request $request)
    {
        $questions = Question::where('exam_id', $request->exam_id)->get();

        $total_mark = 0;
        foreach ($questions as $question) {
            if ($question->question_answer == request($question->id . '_answer')) {
                $total_mark += 1;
            }
            if (request($question['id'] . '_answer')) {
                $answer = new StudentAnswer();
                $answer->user_id = Auth::user()->id;
                $answer->exam_id = $request->exam_id;
                $answer->question_id = $question->id;
                $answer->answer = request($question->id . '_answer');
                $answer->save();
            }
        }

        $student_exam = StudentAssignExam::where('user_id', Auth::user()->id)->where('exam_id', $request->exam_id)->first();
        $student_exam->mark = $total_mark;
        $student_exam->update();

        return redirect()->route('result.view', $request->exam_id);
    }

    public function ResultView($exam_id)
    {
        $assign_check = StudentAssignExam::where('user_id', Auth::user()->id)->where('exam_id', $exam_id)->count();
        if ($assign_check) {
            $data['results'] = StudentAnswer::where('user_id', Auth::user()->id)->where('exam_id', $exam_id)->get();
            if (count($data['results']) > 0) {
                $data['total_correct'] = 0;
                $data['questions'] = Question::with('result')->where('exam_id', $exam_id)->get();
                foreach ($data['questions'] as $question) {
                    if ($question->question_answer == @$question->result->answer) {
                        $data['total_correct']++;
                    }
                }
                return view('user.exam.result_view', $data);
            } else {
                return redirect()->route('exam-test', $exam_id);
            }
        } else {
            echo 'You are not assign this Exam';
        }
    }
}
