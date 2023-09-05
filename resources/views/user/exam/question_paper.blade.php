@extends('user.user_dashboard')

@section('user')
    <section class="banners pt-5">
        <div class="container">
            <form action="{{ route('answer.store') }}" method="POST">
                @csrf

                <input type="hidden" name="exam_id" value="{{ $exam_id }}">
                <div class="row">
                    @if (!$questions->isEmpty())
                        @foreach ($questions as $key => $question)
                            <div class="col-md-6 mt-3">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $question->question_name }}
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_a" value="{{ $question->option_a }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_a">
                                                    {{ $question->option_a }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_b" value="{{ $question->option_b }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_b">
                                                    {{ $question->option_b }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_c" value="{{ $question->option_c }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_c">
                                                    {{ $question->option_c }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_d" value="{{ $question->option_d }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_d">
                                                    {{ $question->option_d }}
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    @else
                        <h6 class="text-center text-warning">Questions are not available! <a class="text-info"
                                href="{{ route('dashboard') }}">Back</a></h6>
                    @endif

                </div>
            </form>
        </div>
    </section>
@endsection
