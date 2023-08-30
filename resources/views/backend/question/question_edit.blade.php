@extends('admin.admin_dashboard')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Question System</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Question</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="#" class="btn btn-primary"> All Question</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Question</h5>
                <hr />
                <form id="myForm" action="{{ route('update.question', $question->id) }}" method="post">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Question</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="question_name" class="form-control"
                                value="{{ $question->question_name }}" />
                            @error('question_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Anawer</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="question_answer" class="form-control"
                                value="{{ $question->question_answer }}" />
                            @error('question_answer')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Option A</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="option_a" class="form-control"
                                value="{{ $question->option_a }}" />
                            @error('option_a')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Option B</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="option_b" class="form-control"
                                value="{{ $question->option_b }}" />
                            @error('option_b')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Option C</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="option_c" class="form-control" value="{{ $question->option_c }}" />
                            @error('option_c')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Option D</h6>
                        </div>
                        <div class=" form-group col-sm-9 text-secondary">
                            <input type="text" name="option_d" class="form-control" value="{{ $question->option_d }}" />
                            @error('option_d')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
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
@endsection
