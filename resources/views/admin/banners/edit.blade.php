@extends('admin.layouts.admin')

@section('title')
    ویرایش بنر
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش بنر : {{ $banner->title }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.banners.update', ['banner' => $banner->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center mb-3">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ url(env('BANNER_IMAGES_UPLOAD_PATH').$banner->image ) }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="d-flex justify-content-center mb-2">
                                    <div class="file-upload form-group col-md-6 ">
                                        <button id="file-upload-btn" class="file-upload-btn btn btn-success" type="button" onclick="$('#image').trigger( 'click' )">انتخاب تصویر</button>

                                        <div id="image-upload-wrap" class="image-upload-wrap">
                                          <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*" name="image" id="image"/>
                                          <div id="image_img"></div>
                                          <div class="drag-text">
                                            <h3> یک تصویر را بکشید و رها کنید یا انتخاب تصویر را بزنید</h3>
                                          </div>
                                        </div>
                                        <div id="file-upload-image-content" class="file-upload-content">
                                            <h5> <b> تصویر بنر </b> </h5>
                                          <img id="file-upload-primary-image" class="file-upload-image" src="#" alt="your image" />
                                          <div id="file-upload-image-wrap" class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image btn btn-danger ">حذف <span class="image-title">آپلود تصویر</span></button>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="title">عنوان</label>
                                    <input class="form-control" id="title" name="title" type="text" value="{{ $banner->title }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="priority">الویت</label>
                                    <input class="form-control" id="priority" name="priority" type="number" value="{{ $banner->priority }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="is_active">وضعیت</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" {{ $banner->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ $banner->getRawOriginal('status') == 0 ? '' : 'selected' }}>غیرفعال</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="type">نوع بنر</label>
                                    <input class="form-control" id="type" name="type" type="text" value="{{ $banner->type }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="button_link">لینک دکمه</label>
                                    <input class="form-control" id="button_link" name="button_link" type="text" value="{{ $banner->button_link }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="button_icon">آیکون دکمه</label>
                                    <input class="form-control" id="button_icon" name="button_icon" type="text" value="{{ $banner->button_icon }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="button_text">متن نمایشی: </label>
                                    <div class="d-flex justify-content-start">
                                    <textarea class="form-control" name="button_text" type="text" rows="15">{{ $banner->button_text }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="text">متن اصلی: </label>
                                    <div class="d-flex justify-content-end">
                                    <textarea class="form-control rounded-0 " id="basic-conf" name="text" rows="3" id="text" type="text">{{ $banner->text }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <button class="btn btn-warning mt-5 mb-5" type="submit">ویرایش</button>
                                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript-code')
<script>

    // Show File Name
    $('#image').change(function() {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

</script>

<script>

    function readURL(input) {
    if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
    $('#image-upload-wrap').hide();
    $('#file-upload-btn').hide();

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
    $('#image').remove();
    $('#image').replaceWith($('#image_img').append('<input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*" name="image" id="image"/>'));
    $('#file-upload-image-content').hide();
    $('#image-upload-wrap').show();
    $('#file-upload-btn').show();
    }
    $('#image-upload-wrap').bind('dragover', function () {
    $('#image-upload-wrap').addClass('image-dropping');
    });
    $('#image-upload-wrap').bind('dragleave', function () {
    $('#image-upload-wrap').removeClass('image-dropping');
    });

</script>
@endsection
