@extends('user.layouts.user')

@section('title')
    امتحان
@endsection

@section('content')
    @php
        $score = App\Models\Score::where('course_id',$exam->course->id)->where('exam_id',$exam->id)->where('user_id',auth()->user()->id)->first();
    @endphp
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <div class="box box-info bg-light">

                        <div class="box-header with-border text-center">
                            <h5 class="font-weight-bold"><b>امتحان : {{ $exam->name }}</b></h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="d-flex justify-content-center mx-5 mt-4">
                                <p>@php
                                    echo $exam->description;
                                @endphp</p>
                                <hr>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-8 mt-3">
                                    <table class="table table-secondary table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>دوره</th>
                                                <th>تعداد سوال</th>
                                                <th>زمان</th>
                                                <th>نمره شما / نمره امتحان</th>
                                                <th>دفعات مجاز شرکت در آزمون</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <th>
                                                        {{ $exam->course->name }}
                                                    </th>
                                                    <th>
                                                        {{ $exam->counter_of_questions }}
                                                    </th>
                                                    <th>
                                                        {{ $exam->time }} دقیقه
                                                    </th>
                                                    <th>
                                                        @php
                                                            if(!empty($score)){
                                                                echo $exam->final_grade .'/' .$score->total_grade;
                                                            }else{
                                                                echo $exam->final_grade .'/' .'0';
                                                            }
                                                        @endphp
                                                    </th>
                                                    <th>
                                                        {{ $exam->allowed_times	 }}
                                                    </th>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                @if (!empty($score))
                                    @if ($exam->allowed_times != $score->exam_visit)
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.exam.show',['exam' => $exam ]) }}" class="btn btn-primary"> شروع آزمون </a>
                                        </div>
                                    @endif
                                
                                @else
                                    <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.exam.show',['exam' => $exam ]) }}" class="btn btn-primary"> شروع آزمون </a>
                                    </div>
                                @endif
                        </div>

                        <a href="{{ route('user.users_profile.orderItems') }}" class="btn btn-secondary mt-2 mb-3 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
