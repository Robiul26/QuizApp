@extends('user.user_dashboard')

@section('user')
    <section class="banners pt-5">
        <div class="container">

            <div class="row">
                <div class="col-md-6"><a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Back</a></div>
                <div class="col-md-6">
                   <span class="text-danger fs-5">Left Time  <span id="timer"></span></span>
                </div>

            </div>
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
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_a"
                                                    value="{{ $question->option_a }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_a">
                                                    {{ $question->option_a }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_b"
                                                    value="{{ $question->option_b }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_b">
                                                    {{ $question->option_b }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_c"
                                                    value="{{ $question->option_c }}">
                                                <label class="form-check-label" for="{{ $question->id }}_option_c">
                                                    {{ $question->option_c }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $question->id }}_answer" id="{{ $question->id }}_option_d"
                                                    value="{{ $question->option_d }}">
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
    @php
        $time = 1;
    @endphp
    <script type="text/javascript">
        var timeoutHandle;

        function countdown(minutes) {
            var seconds = 60;
            var mins = minutes

            function tick() {
                var counter = document.getElementById("timer");
                var current_minutes = mins - 1
                seconds--;
                counter.innerHTML =
                    current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                if (seconds > 0) {
                    timeoutHandle = setTimeout(tick, 1000);
                } else {
                    if (mins > 1) {
                        // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                        setTimeout(function() {
                            countdown(mins - 1);
                        }, 1000);
                    }
                }
            }
            tick();
        }
        countdown('<?php echo $time; ?>');
    </script>

    <!-- script for disable url -->
    <script type="text/javascript">
        var time = '<?php echo $time; ?>';
        var realtime = time * 60000;
        setTimeout(function() {
                alert('Your Time Out!!');
                window.location.href = "{{ route('dashboard') }}";
            },
            realtime);
    </script>
@endsection
