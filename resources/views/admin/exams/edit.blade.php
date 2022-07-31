@extends('admin.layouts.admin')

@section('title')
    ویرایش امتحان
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش امتحان : {{ $exam->name }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.exams.update', ['exam' => $exam->id]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام امتحان</label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ $exam->name }}">
                                </div>
                                <div class="form-group tax-select col-md-3 mt-2">
                                    <label>
                                        دوره
                                    </label>
                                    <select id="courseSelect" class="form-control email s-email s-wid state-select"
                                        name="course_id">
                                        {{ $exam->course_id }}
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" {{ $course->id == $exam->course_id ? 'selected' : '' }} >
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="is_active">وضعیت</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" {{ $exam->getRawOriginal('is_active') ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ $exam->getRawOriginal('is_active') ? '' : 'selected' }}>غیرفعال</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="time">مدت زمان امتحان</label>
                                    <input class="form-control" id="time" name="time" type="number" value="{{ $exam->time }}">
                                    <span class="small text-muted">به دقیقه وارد شود</span>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="randon_number">تعداد سوالات قابل نمایش در امتحان</label>
                                    <input class="form-control" id="randon_number" name="randon_number" type="number" value="{{ $exam->counter_of_questions }}">
                                    <span class="small text-muted">سوالات به صورت رندوم نمایش داده می شوند</span>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="final_grade">نمره نهایی امتحان</label>
                                    <input class="form-control" id="final_grade" name="final_grade" type="text" value="{{ $exam->final_grade }}">
                                    <span class="small text-muted">به صورت عدد اعشاری وارد شود</span>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="allowed_times">تعداد دفعات مجاز شرکت در آزمون</label>
                                    <input class="form-control" id="allowed_times" name="allowed_times" type="text" value="{{ $exam->allowed_times }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="text">توضیحات امتحان: </label>
                                    <div class="d-flex justify-content-center">
                                    <textarea class="form-control rounded-0 " id="basic-conf" name="description" rows="3" type="text">@php
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
                                                    <textarea class="form-control rounded-0 " rows="3" id="text" name="text[{{ $key }}]" type="text">{{ $question->text }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="text">متن گزینه 1: </label>
                                                    <div class="d-flex justify-content-end">
                                                    <textarea class="form-control rounded-0 "  rows="3" id="text" name="q1[{{ $key }}]" type="text">{{ $question->q1 }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="text">متن گزینه 2: </label>
                                                    <div class="d-flex justify-content-end">
                                                    <textarea class="form-control rounded-0" rows="3" id="text" name="q2[{{ $key }}]" type="text">{{ $question->q2 }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="text">متن گزینه 3: </label>
                                                    <div class="d-flex justify-content-end">
                                                    <textarea class="form-control rounded-0 " rows="3" id="text" name="q3[{{ $key }}]" type="text">{{ $question->q3 }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="text">متن گزینه 4: </label>
                                                    <div class="d-flex justify-content-end">
                                                    <textarea class="form-control rounded-0 " rows="3" id="text" name="q4[{{ $key }}]" type="text">{{ $question->q4 }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 mt-2">
                                                    <label>نمره سوال</label>
                                                    <input class="form-control" type="text" name="grade[{{ $key }}]" value="{{ $question->grade }}">
                                                </div>
                                                <div class="form-group col-md-6 mt-2">
                                                    <label>گزینه صحیح</label>
                                                    <input class="form-control"  type="number" name="true_answer[{{ $key }}]" value="{{ $question->true_answer }}">
                                                    <span class="small text-muted">یکی از اعداد 1 تا 4</span>
                                                </div>
                                                {{-- <div class="form-group col-md-12 mt-2">
                                                    <form
                                                    action="{{ route('admin.exams.remove_question', ['question' => $question->id,'exam' => $exam->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger text-right" type="submit">حذف</button>
                                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                </form>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="btn btn-warning mt-5 mb-2 mx-3" type="submit">ویرایش</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">افزودن سوال</h3>
                        </div>
                        {{-- @include('partials.errors') --}}
                        <form action="{{ route('admin.exams.add_question', ['exam' => $exam->id]) }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="col-md-12 mt-3">
                                    <div id="czContainer">
                                        <div id="first">
                                            <div class="recordset">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="text">متن اصلی سوال: </label>
                                                        <div class="d-flex justify-content-end">
                                                        <textarea class="form-control rounded-0 " id="basic-conf" name="text[]" rows="3" id="text" type="text"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="text">متن گزینه 1: </label>
                                                        <div class="d-flex justify-content-end">
                                                        <textarea class="form-control rounded-0 " id="basic-conf" name="q1[]" rows="3" id="text" type="text"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="text">متن گزینه 2: </label>
                                                        <div class="d-flex justify-content-end">
                                                        <textarea class="form-control rounded-0 " id="basic-conf" name="q2[]" rows="3" id="text" type="text"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="text">متن گزینه 3: </label>
                                                        <div class="d-flex justify-content-end">
                                                        <textarea class="form-control rounded-0 " id="basic-conf" name="q3[]" rows="3" id="text" type="text"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="text">متن گزینه 4: </label>
                                                        <div class="d-flex justify-content-end">
                                                        <textarea class="form-control rounded-0 " id="basic-conf" name="q4[]" rows="3" id="text" type="text"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 mt-2">
                                                        <label>نمره سوال</label>
                                                        <input class="form-control" name="grade[]" type="text">
                                                        <span class="small text-muted">به صورت عدد اعشاری وارد شود</span>
                                                    </div>
                                                    <div class="form-group col-md-6 mt-2">
                                                        <label>گزینه صحیح</label>
                                                        <input class="form-control" name="true_answer[]" type="number" min="1" max="4">
                                                        <span class="small text-muted">اعداد 1 تا 4</span>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success mt-5 mb-2 mx-3" type="submit">ثبت</button>
                        </form>
                    </div>
                    <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary mt-2 mr-3">بازگشت</a>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript-code')

    <script>
        $("#czContainer").czMore();
    </script>

@endsection
