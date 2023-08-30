@extends('admin.admin_dashboard')
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
                        <li class="breadcrumb-item active" aria-current="page">All question of <span
                                class="badge rounded-pill bg-success">{{ $exam->exam_name }}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.exam') }}" class="btn btn-info me-2"> Exam List</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add New Question
                    </button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="questionple" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Question Name</th>
                                <th> Option A</th>
                                <th> Option B</th>
                                <th> Option C</th>
                                <th> Option D</th>
                                <th> Answer</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->question_name }}</td>
                                    <td>{{ $item->option_a }}</td>
                                    <td>{{ $item->option_b }}</td>
                                    <td>{{ $item->option_c }}</td>
                                    <td>{{ $item->option_d }}</td>
                                    <td>{{ $item->question_answer }}</td>
                                    <td>
                                        @if ($item->status == 'active')
                                            <span class="badge rounded-pill bg-success">Valid</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Invalid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#staticEdit">
                                            Edit
                                        </button>
                                        <a href="{{ route('delete.question', $item->id) }}" id="delete"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="staticEdit" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticEditLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticEditLabel">Edit Question</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('update.question', $item->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Question</h6>
                                                        </div>
                                                        <div class=" form-group col-sm-9 text-secondary">
                                                            <input type="text" name="question_name" class="form-control"
                                                                value="{{ $item->question_name }}" />
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
                                                            <input type="text" name="question_answer"
                                                                class="form-control"
                                                                value="{{ $item->question_answer }}" />
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
                                                                value="{{ $item->option_a }}" />
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
                                                                value="{{ $item->option_b }}" />
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
                                                            <input type="text" name="option_c" class="form-control"
                                                                value="{{ $item->option_c }}" />
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
                                                            <input type="text" name="option_d" class="form-control"
                                                                value="{{ $item->option_d }}" />
                                                            @error('option_d')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Question Name</th>
                                <th> Option A</th>
                                <th> Option B</th>
                                <th> Option C</th>
                                <th> Option D</th>
                                <th> Answer</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Add new modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store.question') }}" method="post">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Question</h6>
                            </div>
                            <div class=" form-group col-sm-9 text-secondary">
                                <input type="text" name="question_name" class="form-control"
                                    value="{{ old('question_name') }}" />
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
                                    value="{{ old('question_answer') }}" />
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
                                    value="{{ old('option_a') }}" />
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
                                    value="{{ old('option_b') }}" />
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
                                <input type="text" name="option_c" class="form-control"
                                    value="{{ old('option_c') }}" />
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
                                <input type="text" name="option_d" class="form-control"
                                    value="{{ old('option_d') }}" />
                                @error('option_d')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
