@extends('user.user_dashboard')

@section('user')
    <style>
        .red {
            color: red;
        }

        .green {
            color: green;
        }

        .del {
            text-decoration-line: line-through;
        }
    </style>
    <section class="banners pt-5">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-danger mb-5">{{ @$taken_exam }}</h1>
                <h2>Mark: <span class="badge bg-success">Correct {{ $total_correct }} out of {{ count($questions) }}</span></h2>
                @foreach ($questions as $key => $question)
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div
                                class="card-header {{ $question->question_answer == @$question->result->answer ? 'green' : 'red' }}">
                                {{ $question->question_name }}
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}_answer"
                                            id="{{ $question->id }}_option_a"
                                            {{ $question->option_a == @$question->result->answer ? 'checked' : 'disabled' }}>
                                        <label
                                            class="form-check-label  {{ $question->option_a != @$question->result->answer ? 'green' : '' }} "
                                            for="{{ $question->id }}_option_a">
                                            {{ $question->option_a }}
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}_answer"
                                            id="{{ $question->id }}_option_b"
                                            {{ $question->option_b == @$question->result->answer ? 'checked' : 'disabled' }}>
                                        <label class="form-check-label" for="{{ $question->id }}_option_b">
                                            {{ $question->option_b }}
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}_answer"
                                            id="{{ $question->id }}_option_c"
                                            {{ $question->option_c == @$question->result->answer ? 'checked' : 'disabled' }}>
                                        <label class="form-check-label" for="{{ $question->id }}_option_c">
                                            {{ $question->option_c }}
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="{{ $question->id }}_answer"
                                            id="{{ $question->id }}_option_d"
                                            {{ $question->option_d == @$question->result->answer ? 'checked' : 'disabled' }}>
                                        <label class="form-check-label" for="{{ $question->id }}_option_d">
                                            {{ $question->option_d }}
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
