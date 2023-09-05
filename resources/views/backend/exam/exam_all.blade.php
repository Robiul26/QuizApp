@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Exam System</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All exam</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.exam') }}" class="btn btn-primary"> Add Exam</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Exam Name</th>
                                <th> Validity</th>
                                <th> Left Time</th>
                                <th> Question</th>
                                <th> Assign Students</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $key => $item)
                                @php
                                    $question_count = App\Models\Question::where('exam_id', $item->id)->count();
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->exam_name }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->exam_validity)->format('D, d F Y') }}</td>
                                    <td>{{ $item->left_time }} min</td>
                                    <td><a href="{{ route('all.question', $item->id) }}" class="btn btn-secondary">Show
                                            Questions ({{ $question_count }})</a></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal_{{ $item->id }}">
                                            Students
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Assign Students</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (count($item->assign_students) > 0)
                                                            <ul class="list-group">
                                                                @foreach ($item->assign_students as $numb => $assign_student)
                                                                    @php
                                                                        $all_assign_students = App\Models\User::where('role', 'user')
                                                                            ->where('id', $assign_student->user_id)
                                                                            ->orderBy('name', 'ASC')
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($all_assign_students as $student)
                                                                        <li class="list-group-item">
                                                                            {{ $numb + 1 }}. {{ $student->name }}
                                                                        </li>
                                                                    @endforeach
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-center text-danger">Not Assigned to any student!
                                                            </p>
                                                        @endif

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->exam_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge rounded-pill bg-success">Valid</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Invalid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.exam', $item->id) }}" class="btn btn-info">Edit</a>

                                        @if ($question_count == 0)
                                            <a href="{{ route('delete.exam', $item->id) }}" id="delete"
                                                class="btn btn-danger">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Exam Name</th>
                                <th> Validity</th>
                                <th> Left Time</th>
                                <th> Question</th>
                                <th> Assign Students</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
