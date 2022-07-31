@extends('admin.layouts.admin')

@section('title')
    ویرایش دوره آموزشی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش دوره آموزشی : {{ $course->name }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.courses.update', ['course' => $course->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-row row">
                                <div class="form-group col-md-3">
                                    <label for="name">نام</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                        value="{{ $course->name }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="slug">نام انگلیسی</label>
                                    <input class="form-control" id="slug" name="slug" type="text"
                                        value="{{ $course->slug }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="is_active">وضعیت</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" {{ $course->getRawOriginal('is_active') ? 'selected' : '' }}>
                                            فعال</option>
                                        <option value="0" {{ $course->getRawOriginal('is_active') ? '' : 'selected' }}>
                                            غیرفعال</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="tag_ids">تگ</label>
                                    <select id="tagSelect" name="tag_ids[]" class="form-control" multiple
                                        data-live-search="true">
                                        @php
                                            $courseTagIds = $course
                                                ->tags()
                                                ->pluck('id')
                                                ->toArray();
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, $courseTagIds) ? 'selected' : '' }}>
                                                {{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 mt-3">
                                    <label for="text">توضیحات: </label>
                                    <div class="d-flex justify-content-center">
                                    <textarea class="form-control rounded-0 " id="basic-conf" name="description" rows="3" id="text" type="text">{{ $course->description }}</textarea>
                                    </div>
                                </div>

                                {{-- Delivery Section --}}
                                <div class="col-md-12">
                                    <hr>
                                    <p>هزینه دوره : </p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="delivery_amount">هزینه دوره</label>
                                    <input class="form-control" id="delivery_amount" name="price" type="text"
                                        value="{{ $course->price }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="delivery_amount">هزینه ارسال</label>
                                    <input class="form-control" id="delivery_amount" name="delivery_amount" type="text"
                                        value="{{ $course->delivery_amount }}">
                                </div>
                                {{-- Sale Section --}}
                                <div class="col-md-12 mt-3">
                                    <hr>
                                    <p> حراج : </p>
                                </div>

                                <div class="form-group col-md-4">
                                    <label> قیمت حراجی </label>
                                    <input type="text" name="sale_price" value="{{ $course->sale_price }}"
                                        class="form-control">
                                </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInput1">تاریخ شروع حراجی</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" data-mddatetimepicker="true"
                                                data-targetselector="#exampleInput1" data-trigger="click" data-enabletimepicker="true">
                                                <span><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="exampleInput1"
                                                name="date_on_sale_from"
                                                value="{{ $course->date_on_sale_from == null ? null : verta($course->date_on_sale_from) }}" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInput3">تاریخ پایان حراجی</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" data-mddatetimepicker="true"
                                                data-targetselector="#exampleInput3" data-trigger="click" data-enabletimepicker="true">
                                                <span><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="exampleInput3"
                                                name="date_on_sale_to"
                                                value="{{ $course->date_on_sale_to == null ? null : verta($course->date_on_sale_to) }}" />
                                        </div>
                                    </div>


                                {{-- Attributes & movies --}}
                                <div class="col-md-12">
                                    <hr>
                                    <p>ویژگی ها : </p>
                                </div>
                                @foreach ($courseAttributes as $courseAttribute)
                                    <div class="form-group col-md-4">
                                        <label>{{ $courseAttribute->attribute->name }}</label>
                                        <input class="form-control" type="text"
                                            name="attribute_values[{{ $courseAttribute->id }}]"
                                            value="{{ $courseAttribute->value }}">
                                    </div>
                                @endforeach

                            </div>
                            <button class="btn btn-warning mt-5 mb-5" type="submit">ویرایش</button>
                            <a href="{{ route('admin.courses.index') }}"
                                class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                        </form>
                        @foreach ($movies as $key => $movie)
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="container d-flex justify-content-between">
                                            <p class="mb-0 ml-3"> فیلم برای ( {{ $movie->movie_name }} ) :
                                            </p>
                                            <p class="mb-0 mr-3">
                                                <div class="d-flex">
                                                    <button class="btn btn-sm btn-outline-primary mx-3" type="button"
                                                    data-toggle="collapse" data-target="#collapse-{{ $movie->id }}">
                                                    نمایش </button>
                                                <form
                                                    action="{{ route('admin.courses.movies.destroy', ['course' => $course->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger text-right" type="submit">حذف</button>
                                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                                </form>
                                                </div>
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
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript-code')
    <script type="text/javascript">
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });
        $('#input1').change(function() {
            var $this = $(this),
                value = $this.val();
            alert(value);
        });
        $('#textbox1').change(function() {
            var $this = $(this),
                value = $this.val();
            alert(value);
        });
        $('[data-name="disable-button"]').click(function() {
            $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable',
                true);
        });
        $('[data-name="enable-button"]').click(function() {
            $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable',
                false);
        });
    </script>
    <script>
        $(document).on('change', '.up', function() {
            var movie_download_link = [];
            var length = $(this).get(0).files.length;
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                movie_download_link.push($(this).get(0).files[i].name);
            }
            // $("input[name=file]").val(names);
            if (length > 2) {
                var fileName = movie_download_link.join(', ');
                $(this).closest('.form-group').find('.form-control').attr("value", length + " files selected");
            } else {
                $(this).closest('.form-group').find('.form-control').attr("value", movie_download_link);
            }
        });
    </script>

@endsection
