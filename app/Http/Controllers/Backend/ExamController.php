<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\StudentAssignExam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    // All Exam
    public function Allexam()
    {
        $data['exams'] = Exam::with('assign_students')->latest()->get();
        return view('backend.exam.exam_all', $data);
    }

    public function Addexam()
    {
        $data['students'] = User::where('role', 'user')->orderBy('name', 'ASC')->get();
        return view('backend.exam.exam_add', $data);
    }

    // Store Exam
    public function Storeexam(Request $request)
    {
        // Validation
        $request->validate([
            'exam_name' => 'required',
            'exam_validity' => 'required'
        ]);

        $exam = new Exam();
        $exam->exam_name = $request->exam_name;
        $exam->exam_validity = $request->exam_validity;
        $exam->save();

        if (count($request->assign_to) > 0) {
            foreach ($request->assign_to as $assign_to) {
                $user_assign = new StudentAssignExam();
                $user_assign->user_id = $assign_to;
                $user_assign->exam_id = $exam->id;
                $user_assign->save();
            }
        }

        $notification = array(
            'message' => 'Exam Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.exam')->with($notification);
    }

    // Edit Exam
    public function Editexam($id)
    {
        $data['exam'] = Exam::findOrFail($id);
        $data['assign_users'] = StudentAssignExam::select('user_id')->where('exam_id', $data['exam']->id)->orderBy('id', 'ASC')->get();
        $data['users'] = User::where('role', 'user')->orderBy('name', 'ASC')->get();
        return view('backend.exam.exam_edit', $data);
    }

    // Update Exam 
    public function Updateexam(Request $request, $id)
    {

        // Validation
        $request->validate([
            'exam_name' => 'required',
            'exam_validity' => 'required'
        ]);

        $exam = Exam::find($id);
        $exam->exam_name = $request->exam_name;
        $exam->exam_validity = $request->exam_validity;
        $exam->update();

        if ($exam->update()) {
            $assign_to = $request->assign_to;
            if (!empty($assign_to)) {
                StudentAssignExam::where('exam_id', $id)->delete();
                foreach ($request->assign_to as $assign_to) {
                    $user_assign = new StudentAssignExam();
                    $user_assign->user_id = $assign_to;
                    $user_assign->exam_id = $exam->id;
                    $user_assign->save();
                }
            }
        }

        $notification = array(
            'message' => 'Exam Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.exam')->with($notification);
    }

    // Delete Exam
    public function Deleteexam($id)
    {
        $item = Exam::findOrFail($id);
        $item->delete();

        $notification = array([
            'message' => 'Exam Deleted Successfully',
            'alert-type' => 'success'
        ]);

        return redirect()->back()->with($notification);
    }
}
