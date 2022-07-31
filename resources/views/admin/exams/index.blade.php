@extends('admin.layouts.admin')

@section('title')
    امتحانات
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <div class="box box-info">
                        <div class="box-header">
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="font-weight-bold">لیست امتحانات ({{ $exams->total() }})</h5>
                            @can('exam-create')
                            <a class="btn btn-sm btn-success" href="{{ route('admin.exams.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد امتحان
                            </a>
                            @endcan
                        </div>
                        <div>
                            <table class="table table-secondary table-bordered table-striped text-center">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>دوره</th>
                                        <th>تعداد سوال</th>
                                        <th>زمان</th>
                                        <th>نمره</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $key => $exam)
                                        <tr>
                                            <th>
                                                {{ $key+1 }}
                                            </th>
                                            <th>
                                                {{ $exam->name }}
                                            </th>
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
                                                {{ $exam->final_grade }}
                                            </th>
                                            <th>
                                                <span
                                                    class="{{ $exam->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                                    {{ $exam->is_active }}
                                                </span>
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold"
                                                    href="{{ route('admin.exams.show', ['exam' => $exam->id]) }}">نمایش</a>
                                                @can('exam-edit')
                                                <a class="btn btn-sm btn-outline-warning text-bold mr-3"
                                                    href="{{ route('admin.exams.edit', ['exam' => $exam->id]) }}">ویرایش</a>
                                                @endcan
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $exams->withQueryString()->onEachSide(2)->render() }}
                </div>
            </div>
        </section>
    </div>
@endsection
