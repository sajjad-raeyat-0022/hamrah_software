@extends('user.layouts.user')

@section('title')
    امتحان
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

                    <div class="box box-info bg-light">
                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">امتحان : {{ $exam->name }}</h5>
                            <h5 class="text-bold text-danger"> زمان باقیمانده: <b id="timer"></b></h5>
                        </div>
                        <form id="questionForm" action="{{ route('user.exam.store',['exam' => $exam]) }}" method="POST">
                            @csrf
                            <div class="row">
                                @foreach ($questions as $key => $question)
                                    <div class="accordion col-md-12 mt-3 mb-3" id="question">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <button class="btn btn-link btn-block text-bold text-primary text-right"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#collapseQuestion-{{ $key }}" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    سوال شماره {{ $key + 1 }} / <font style="color:red;">نمره: {{ $question->grade }}</font>
                                                </button>
                                            </div>

                                            <div id="collapseQuestion-{{ $key }}" class="collapse col-md-12"
                                                aria-labelledby="headingOne" data-parent="#question">
                                                <div class="card-body row">
                                                    <div class="form-group col-md-12">
                                                        <label for="text">متن اصلی سوال: </label>
                                                        <div class="d-flex justify-content-start">
                                                            <p>{{ $question->text }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="form-group col-md-6">
                                                            <label class="mx-2"
                                                                for="q1-{{ $key }}">{{ $question->q1 }}</label>
                                                            <input type="radio" id="q1-{{ $key }}"
                                                                name="answer[{{ $key }}]" value="1">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="mx-2"
                                                                for="q2-{{ $key }}">{{ $question->q2 }}</label>
                                                            <input type="radio" id="q2-{{ $key }}"
                                                                name="answer[{{ $key }}]" value="2">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="mx-2"
                                                                for="q3-{{ $key }}">{{ $question->q3 }}</label>
                                                            <input type="radio" id="q3-{{ $key }}"
                                                                name="answer[{{ $key }}]" value="3">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="mx-2"
                                                                for="q4-{{ $key }}">{{ $question->q4 }}</label>
                                                            <input type="radio" id="q4-{{ $key }}"
                                                                name="answer[{{ $key }}]" value="4">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mt-2" hidden>
                                                        <input class="form-control"  type="number" id="true_answer" name="true_answer[{{ $key }}]" value="{{ $question->true_answer }}" hidden>
                                                    </div>
                                                    <div class="form-group col-md-6 mt-2" hidden>
                                                        <input class="form-control"  type="text" name="grade[{{ $key }}]" value="{{ $question->grade }}" hidden>
                                                    </div>
                                                    <div class="form-group col-md-6 mt-2" hidden>
                                                        <input class="form-control"  type="text" name="course_id" value="{{ $exam->course->id }}" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <button class="btn btn-success mt-5 mb-5" type="submit">ثبت همه پاسخ ها</button>
                            <a href="{{ route('user.users_profile.orderItems') }}"
                                class="btn btn-danger mt-5 mb-5 mx-3">انصراف از آزمون</a>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript-code')
    <script>
        timer();
        function timer() {
            let time = "{{ $exam->time .':00' }}";
            let interval = setInterval(function() {
                let countdown = time.split(':');
                let minutes = parseInt(countdown[0], 10);
                let seconds = parseInt(countdown[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) {
                    clearInterval(interval);
                    $('#questionForm').submit();
                };
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('#timer').html(minutes + ':' + seconds);
                time = minutes + ':' + seconds;
            }, 1000);
        }
    </script>
@endsection
