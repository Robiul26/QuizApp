@extends('admin.admin_dashboard')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
                        <li class="breadcrumb-item active" aria-current="page">Edit Exam</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.exam') }}" class="btn btn-primary"> All Exam</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Exam</h5>
                <hr />
                <form id="myForm" action="{{ route('update.exam', $exam->id) }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Exam Name</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="exam_name" class="form-control" value="{{ $exam->exam_name }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Exam Validity</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="date" name="exam_validity" class="form-control"
                                value="{{ $exam->exam_validity }}" min={{ Carbon\Carbon::now()->format('Y-m-d') }} />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Left Time</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="number" name="left_time" class="form-control" value="{{ $exam->left_time }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Assign To</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <select class="js-example-basic-multiple form-control" name="assign_to[]" multiple="multiple">
                                @foreach ($users as $student)
                                    @if (!$assign_users->isEmpty())
                                        @foreach ($assign_users as $assign_user)
                                            <option value="{{ $student->id }}"
                                                {{ $assign_user->user->id == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
