@extends('admin.layouts.admin')

@section('title')
    ایجاد امتحان
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد امتحان</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.exams.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام امتحان</label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                                </div>

                                <div class="form-group tax-select col-md-3 mt-2">
                                    <label>
                                        دوره
                                    </label>
                                    <select id="courseSelect" class="form-control email s-email s-wid state-select"
                                        name="course_id" title="انتخاب دوره">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="is_active">وضعیت</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="time">مدت زمان امتحان</label>
                                    <input class="form-control" id="time" name="time" type="number" value="{{ old('time') }}">
                                    <span class="small text-muted">به دقیقه وارد شود</span>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="randon_number">تعداد سوالات قابل نمایش در امتحان</label>
                                    <input class="form-control" id="randon_number" name="randon_number" type="number" value="{{ old('random_number') }}">
                                    <span class="small text-muted">سوالات به صورت رندوم نمایش داده می شوند</span>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="final_grade">نمره نهایی امتحان</label>
                                    <input class="form-control" id="final_grade" name="final_grade" type="text" value="{{ old('final_grade') }}">
                                    <span class="small text-muted">به صورت عدد اعشاری وارد شود</span>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="allowed_times">تعداد دفعات مجاز شرکت در آزمون</label>
                                    <input class="form-control" id="allowed_times" name="allowed_times" type="text" value="{{ old('allowed_times') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="text">توضیحات امتحان: </label>
                                    <div class="d-flex justify-content-center">
                                    <textarea class="form-control rounded-0 " id="basic-conf" name="description" rows="3" type="text"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12"><h4 class="mx-3">افزودن سوال: </h4></div>
                                <div class="col-md-12 mt-2">
                                    <div id="czContainer">
                                        <div id="first">
                                            <div class="recordset">

                                                <div class="row">

                                                    <div class="form-group col-md-12">
                                                        <label for="text">متن اصلی سوال: </label>
                                                        <div class="d-flex justify-content-end">
                                                        <textarea class="form-control rounded-0 " id="basic-conf" name="text[]" rows="3" type="text"></textarea>
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
                            <button class="btn btn-success mt-5 mb-5" type="submit">ثبت</button>
                            <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript-code')

    <script>
        $('#courseSelect').selectpicker({
            'title': 'انتخاب دوره'
        });

        $("#czContainer").czMore();
    </script>

@endsection
