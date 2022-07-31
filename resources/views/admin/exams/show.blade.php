@extends('admin.layouts.admin')

@section('title')
    امتحان
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">امتحان : {{ $exam->name }}</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 mt-2">
                                <label for="name">نام امتحان</label>
                                <input class="form-control" id="name" type="text" value="{{ $exam->name }}" disabled>
                            </div>
                            <div class="form-group tax-select col-md-3 mt-2">
                                <label>
                                    دوره
                                </label>
                                <input class="form-control" type="text" value="{{ $exam->course->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="is_active">وضعیت</label>
                                <input class="form-control" type="text" value="{{ $exam->getRawOriginal('is_active') ? 'فعال' : 'غیر فعال' }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="time">مدت زمان امتحان</label>
                                <input class="form-control" type="number" value="{{ $exam->time }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="randon_number">تعداد سوالات قابل نمایش در امتحان</label>
                                <input class="form-control" type="number" value="{{ $exam->counter_of_questions }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="final_grade">نمره نهایی امتحان</label>
                                <input class="form-control" type="text" value="{{ $exam->final_grade }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-2">
                                <label for="allowed_times">تعداد دفعات مجاز شرکت در آزمون</label>
                                <input class="form-control" id="allowed_times" name="allowed_times" type="text" value="{{ $exam->allowed_times }}" disabled>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="text">توضیحات امتحان: </label>
                                <div class="d-flex justify-content-center">
                                <textarea class="form-control rounded-0 " name="description" rows="3" type="text" disabled>@php
                                    echo $exam->description;
                                @endphp</textarea>
                                </div>
                            </div>
                            @foreach ($questions as $key => $question)
                            <div class="accordion col-md-12 mt-3 mb-3" id="question">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                            <button class="btn btn-link btn-block text-bold text-primary text-right" type="button" data-toggle="collapse"
                                                data-target="#collapseQuestion-{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                                                سوال شماره {{ $key+1 }}
                                            </button>
                                    </div>

                                    <div id="collapseQuestion-{{ $key }}" class="collapse col-md-12" aria-labelledby="headingOne"
                                        data-parent="#question">
                                        <div class="card-body row">
                                            <div class="form-group col-md-12">
                                                <label for="text">متن اصلی سوال: </label>
                                                <div class="d-flex justify-content-end">
                                                <textarea class="form-control rounded-0 " rows="3" id="text" type="text" disabled>{{ $question->text }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="text">متن گزینه 1: </label>
                                                <div class="d-flex justify-content-end">
                                                <textarea class="form-control rounded-0 "  rows="3" id="text" type="text" disabled>{{ $question->q1 }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="text">متن گزینه 2: </label>
                                                <div class="d-flex justify-content-end">
                                                <textarea class="form-control rounded-0" rows="3" id="text" type="text" disabled>{{ $question->q2 }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="text">متن گزینه 3: </label>
                                                <div class="d-flex justify-content-end">
                                                <textarea class="form-control rounded-0 " rows="3" id="text" type="text" disabled>{{ $question->q3 }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="text">متن گزینه 4: </label>
                                                <div class="d-flex justify-content-end">
                                                <textarea class="form-control rounded-0 " rows="3" id="text" type="text" disabled>{{ $question->q4 }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 mt-2">
                                                <label>نمره سوال</label>
                                                <input class="form-control" type="text" value="{{ $question->grade }}" disabled>
                                            </div>
                                            <div class="form-group col-md-6 mt-2">
                                                <label>گزینه صحیح</label>
                                                <input class="form-control"  type="number" value="{{ $question->true_answer }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary mt-2 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
