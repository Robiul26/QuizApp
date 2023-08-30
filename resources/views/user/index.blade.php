@extends('user.user_dashboard')

@section('user')
    <section class="banners pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="">Welcome {{ Auth::user()->name }}!</h1>
                    <h2 class="">What's your multiple choice quistion?</h2>
                </div>
                <div class="col-md-4">
                    <h2 class="text-center">Test Yourself</h2>
                    @if (!$exams->isEmpty())
                        @foreach ($exams as $exam)
                            <p class="bg-light p-2"><a class="link-opacity-10-hover nav-link fs-5 text-center"
                                    href="#">{{ $exam->exam_name }}</a></p>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
