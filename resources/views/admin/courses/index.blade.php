@extends('admin.layouts.admin')

@section('title')
    دوره های آموزشی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content ">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white ">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="font-weight-bold">لیست دوره های آموزشی ({{ $courses->total() }})</h5>
                            @can('create-course')
                                <a class="btn btn-sm btn-success" href="{{ route('admin.courses.create') }}">
                                    <i class="fa fa-plus"></i>
                                    ایجاد دوره آموزشی
                                </a>
                            @endcan
                        </div>
                        <div>
                            <table class="table table-secondary table-bordered table-striped text-center">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>دسته بندی</th>
                                        <th>وضعیت</th>
                                        <th>قیمت</th>
                                        @can('edit-course')
                                            <th>عملیات</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $key => $course)
                                        <tr>
                                            <th>
                                                {{ $courses->firstItem() + $key }}
                                            </th>
                                            <th>
                                                <a class="text-primary"
                                                    href="{{ route('admin.courses.show', ['course' => $course->id]) }}">
                                                    {{ $course->name }} </a>
                                            </th>

                                            <th>
                                                {{ $course->category->name }}
                                            </th>
                                            <th>
                                                <span
                                                    class="{{ $course->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                                    {{ $course->is_active }} </span>
                                            </th>
                                            <th>
                                                {{ $course->price === 0 ? 'رایگان' : $course->price . ' تومان ' }}
                                            </th>
                                            @can('edit-course')
                                                <th>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-info dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            عملیات
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a href="{{ route('admin.courses.edit', ['course' => $course->id]) }}"
                                                                class="dropdown-item text-right"> ویرایش دوره </a>

                                                            <a href="{{ route('admin.courses.movies.edit', ['course' => $course->id]) }}"
                                                                class="dropdown-item text-right"> ویرایش تصویر و فیلم ها </a>

                                                            <a href="{{ route('admin.courses.category.edit', ['course' => $course->id]) }}"
                                                                class="dropdown-item text-right"> ویرایش دسته بندی </a>

                                                        </div>
                                                    </div>
                                                </th>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $courses->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $courses->fragment('courses')->links() }} --}}
                    {{-- {{ $courses->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
