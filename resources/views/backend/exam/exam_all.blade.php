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
                                <th> Question</th>
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
                                    <td><a href="{{ route('all.question', $item->id) }}" class="btn btn-secondary">Show
                                            Questions ({{ $question_count }})</a></td>
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
