@extends('user.user_dashboard')

@section('user')
    <section class="banners pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="">Welcome! <span class="text-warning">{{ Auth::user()->name }}</span></h1>
                    <h2 class="">What's your multiple choice quistion?</h2>
                </div>
                <div class="col-md-4">
                    <h2 class="text-center">Test Yourself</h2>

                    @if (!$assign_exams->isEmpty())
                        @foreach ($assign_exams as $assign_exam)
                            @foreach ($exams as $exam)
                                @if ($exam->id == $assign_exam->exam->id)
                                    <p class="bg-secondary-subtle p-2"><a class="link-opacity-10-hover nav-link fs-5 text-center"
                                            href="{{ route('exam-test', $exam->id) }}">{{ $assign_exam->exam->exam_name }}</a>
                                    </p>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        <h6 class="text-center text-warning">You have no Exam Test!</h6>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
