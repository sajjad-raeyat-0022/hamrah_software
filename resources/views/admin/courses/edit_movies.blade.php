@extends('admin.layouts.admin')

@section('title')
    ویرایش فیلم ها و تصویر دوره آموزشی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش فیلم ها و تصویر اصلی دوره آموزشی : {{ $course->name }}</h3>
                        </div>
                        @include('partials.errors')

                        <div class=" row">
                            {{-- Image --}}
                            <div class="col-md-12">
                                <hr>
                                <h5 class="mx-3">تصویر اصلی و ویدئو پیش نمایش دوره : </h5>
                                <br>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.courses.movies.set', ['course' => $course->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="container text-center d-flex justify-content-center mb-2">
                                        <div class="col-md-5 ">
                                            <div class="card">
                                                <img class="card-img-top"
                                                    src="{{ url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"
                                                    height="300" alt="{{ $course->name }}">
                                            </div>
                                        </div>
                                        <div class="file-upload form-group col-md-5 ">

                                            <button id="file-upload-btn1" class="file-upload-btn btn btn-success"
                                                type="button" onclick="$('#primary_image').trigger( 'click' )">انتخاب
                                                تصویر اصلی جدید</button>

                                            <div id="image-primary-upload-wrap" class="image-upload-wrap ">
                                                <input class="file-upload-input" type="file" onchange="readURL(this);"
                                                    accept="image/*" name="primary_image" id="primary_image" />
                                                <div id="primary_img"></div>
                                                <div class="drag-text text-dark">
                                                    <h3> یک تصویر را بکشید و رها کنید یا انتخاب تصویر اصلی جدید را بزنید
                                                    </h3>
                                                </div>
                                            </div>
                                            <div id="file-upload-image-content" class="file-upload-content">
                                                <h5> <b> تصویر اصلی جدید </b> </h5>
                                                <img id="file-upload-primary-image" class="file-upload-image" src="#"
                                                    alt="your image" />
                                                <div id="file-upload-image-wrap" class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()"
                                                        class="remove-image btn btn-danger ">حذف <span
                                                            class="image-title">آپلود تصویر</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mx-3 col-md-12 text-center">
                                        <button type="submit" class="btn btn-warning btn-sm mt-3"> تایید و ویرایش </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <p> ویدئوی پیش نمایش <span class="font-weight-bold" id="variationName"></span>
                                    :
                                </p>
                            </div>
                            <form action="{{ route('admin.courses.movies.set_primary_video', ['course' => $course->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="d-flex justify-content-center">
                                <div id="pro-primary-{{ $course->id }}" class="item col-md-7 mt-3">
                                    <video controls style="height: 350px; width:600px"
                                        poster="{{ url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"">
                                                                                    <source src="
                                        {{ url(env('EDU_COURSE_MOVIES_UPLOAD_PATH') . $course->primary_video) }}"
                                        type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="form-group form-input-video-group col-md-6 mt-4">
                                    <div class="input-group">

                                        <div class="input-group-btn">
                                            <span class="fileUpload btn btn-success ">
                                                <span class="upl" id="upload">آپلود فایل
                                                    ویدئویی پیش نمایش دوره</span>
                                                <input type="file" class="upload up" id="up"
                                                    onchange="readVideoURL(this);" accept="video/mp4"
                                                    name="primary_video" />

                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-input-video-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-3 col-md-12 text-center">
                                <button type="submit" class="btn btn-warning btn-sm mt-3"> تایید و ویرایش </button>
                            </div>
                        </form>

                            <div id="attributesContainer" class="col-md-12">
                                <div id="attributes" class="row"></div>
                                <div class="col-md-12">
                                    <hr>
                                    <p>افزودن ویدئو برای دوره <span class="font-weight-bold" id="variationName"></span>
                                        :
                                    </p>
                                </div>
                                <form action="{{ route('admin.courses.movies.add', ['course' => $course->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div id="czContainer">
                                        <div id="first">
                                            <div class="recordset">
                                                <div class="container">
                                                    <div class="form-group col-md-4 mt-2">
                                                        <label>نام</label>
                                                        <input class="form-control" name="movie_name[]" type="text">
                                                    </div>
                                                    <div class="form-group form-input-video-group col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-btn">
                                                                <span class="fileUpload btn btn-success ">
                                                                    <span class="upl" id="upload">آپلود فایل
                                                                        ویدئویی</span>
                                                                    <input type="file" class="upload up" id="up"
                                                                        onchange="readVideoURL(this);" accept="video/mp4"
                                                                        name="movie_download_link[]" />
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-input-video-control"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-warning mt-5 mb-5" type="submit">ویرایش</button>
                                    <a href="{{ route('admin.courses.index') }}"
                                        class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                                </form>
                            </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

@section('javascript-code')

    <script>
        $('#primary_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image-primary-upload-wrap').hide();
                    $('#file-upload-btn1').hide();

                    $('#file-upload-primary-image').attr('src', e.target.result);
                    $('#file-upload-image-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('#primary_image').remove();
            $('#primary_image').replaceWith($('#primary_img').append(
                '<input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*" name="primary_image" id="primary_image"/>'
            ));
            $('#image-primary-upload-wrap').show();
            $('#file-upload-btn1').show();
            $('#file-upload-image-content').hide();

        }
        $('#image-primary-upload-wrap').bind('dragover', function() {
            $('#image-primary-upload-wrap').addClass('image-dropping');
        });
        $('#image-primary-upload-wrap').bind('dragleave', function() {
            $('#image-primary-upload-wrap').removeClass('image-dropping');
        });

        $("#czContainer").czMore();
    </script>
    <script>
        $(document).on('change', '.up', function() {
            var movie_download_link = [];
            var length = $(this).get(0).files.length;
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                movie_download_link.push($(this).get(0).files[i].name);
            }
            // $("input[name=file]").val(movie_download_link);
            if (length > 2) {
                var fileName = movie_download_link.join(', ');
                $(this).closest('.form-input-video-group').find('.form-input-video-control').attr("value", length +
                    " files selected");
            } else {
                $(this).closest('.form-input-video-group').find('.form-input-video-control').attr("value",
                    movie_download_link);
            }
        });
    </script>
@endsection
