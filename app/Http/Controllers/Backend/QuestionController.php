<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // All Question
    public function AllQuestion($exam_id)
    {
        $data['exam'] = Exam::findOrFail($exam_id);
        $data['questions'] = Question::where('exam_id', $exam_id)->latest()->get();
        return view('backend.question.question_all', $data);
    }

    public function AddQuestion()
    {
        return view('backend.question.question_add');
    }

    // Store Question
    public function StoreQuestion(Request $request)
    {
        // Validation
        $request->validate([
            'question_name' => 'required',
            'question_answer' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
        ]);

        Question::insert([
            'question_name' => $request->question_name,
            'question_answer' => $request->question_answer,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'exam_id' => $request->exam_id,
            'status' => 'active',
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Question Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Edit Question
    public function EditQuestion($id)
    {
        $data['question'] = Question::findOrFail($id);
        return view('backend.question.question_edit', $data);
    }

    // Update Question 
    public function UpdateQuestion(Request $request, $id)
    {
        Question::findOrFail($id)->update([
            'question_name' => $request->question_name,
            'question_answer' => $request->question_answer,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Question Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Delete Question
    public function DeleteQuestion($id)
    {
        $item = Question::findOrFail($id);
        $item->delete();

        $notification = array([
            'message' => 'Question Deleted Successfully',
            'alert-type' => 'success'
        ]);

        return redirect()->back()->with($notification);
    }
}
