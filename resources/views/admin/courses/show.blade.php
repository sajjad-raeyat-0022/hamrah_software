@extends('admin.layouts.admin')

@section('title')
     دوره آموزشی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">دوره آموزشی : {{ $course->name }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>تصویر اصلی محصول : </h5>
                                <br>
                            </div>

                            <div class="container text-center d-flex justify-content-center mb-4">
                                <div class="col-md-5">
                                    <div class="card">
                                        <img class="card-img-top"
                                            src="{{ url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"
                                            height="300" alt="{{ $course->name }}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group col-md-3">
                                <label>نام</label>
                                <input class="form-control" type="text" value="{{ $course->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>نام انگلیسی</label>
                                <input class="form-control" type="text" value="{{ $course->slug }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>نام دسته بندی</label>
                                <input class="form-control" type="text" value="{{ $course->category->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>وضعیت</label>
                                <input class="form-control" type="text" value="{{ $course->is_active }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label>تگ ها</label>
                                <div class="form-control div-disabled">
                                    @foreach ($course->tags as $tag)
                                    {{ $tag->name }} {{ $loop->last ? '' : ',' }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label>تاریخ ایجاد</label>
                                <input class="form-control" type="text" value="{{ verta($course->created_at) }}" disabled>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label>توضیحات</label>
                                <textarea class="form-control" rows="3" disabled>{{ $course->description }}</textarea>
                            </div>

                            {{-- Delivery Section --}}
                            <div class="col-md-12">
                                <hr>
                                <p>هزینه ها : </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label>هزینه دوره</label>
                                <input class="form-control" type="text" value="{{ $course->price }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>هزینه ارسال</label>
                                <input class="form-control" type="text" value="{{ $course->delivery_amount }}" disabled>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <p>ویژگی ها : </p>
                            </div>
                            @foreach ($courseAttributes as $courseAttribute)
                                <div class="form-group col-md-3">
                                    {{-- <label>{{ \Appa\Models\Attribute::find($courseAttribute->attribute_id)->name }}</label> --}}
                                    <label>{{ $courseAttribute->attribute->name }}</label>
                                    <input class="form-control" type="text" value="{{ $courseAttribute->value }}" disabled>
                                </div>
                            @endforeach

                            {{-- Sale Section --}}
                            <div class="col-md-12 mt-3">
                                <hr>
                                <p> حراج : </p>
                            </div>

                            <div class="form-group col-md-5">
                                <label> قیمت حراجی </label>
                                <input type="text" value="{{ $course->sale_price }}" disabled
                                    class="form-control">
                            </div>

                            <div class="col-md-12 row mt-3">
                                <div class="form-group col-md-6">
                                    <label> تاریخ شروع حراجی </label>
                                    <input type="text"
                                        value="{{ $course->date_on_sale_from == null ? null : verta($course->date_on_sale_from) }}"
                                        disabled class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label> تاریخ پایان حراجی </label>
                                    <input type="text"
                                        value="{{ $course->date_on_sale_to == null ? null : verta($course->date_on_sale_to) }}"
                                        disabled class="form-control">
                                </div>
                            </div>
                            @foreach ($movies as $key => $movie)
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="container d-flex justify-content-between">
                                            <p class="mb-0 ml-3"> قیمت و فیلم برای ( {{ $movie->movie_name }} ) :
                                            </p>
                                            <p class="mb-0 mr-3">
                                                <button class="btn btn-sm btn-outline-primary mr-2" type="button"
                                                    data-toggle="collapse" data-target="#collapse-{{ $movie->id }}">
                                                    نمایش </button>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="collapse mt-2" id="collapse-{{ $movie->id }}">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5>ویدئوی مربوطه : </h5>
                                                        <br>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <video controls height="400"
                                                                poster="{{ url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"">
                                                                        <source src="
                                                                {{ url(env('EDU_COURSE_MOVIES_UPLOAD_PATH') . $movie->movie_download_link) }}"
                                                                type="video/mp4">
                                                            </video>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mt-3">
                                                        <label> نام </label>
                                                        <input type="text" disabled class="form-control"
                                                            value="{{ $movie->movie_name }}">
                                                    </div>
                                                     {{-- <div class="form-group col-md-6 mt-3">
                                                        <label> قیمت </label>
                                                        <input type="text" disabled class="form-control"
                                                            value="{{ $movie->movie_price }}">
                                                    </div> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary mt-3 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
