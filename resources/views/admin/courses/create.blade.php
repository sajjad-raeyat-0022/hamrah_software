@extends('admin.layouts.admin')

@section('title')
    ایجاد دوره آموزشی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد دوره آموزشی</h3>
                        </div>
                        @include('partials.errors')
                        <form id="uploadForm" action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row row">
                                <div class="form-group col-md-3">
                                    <label for="name">نام</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="slug">نام انگلیسی</label>
                                    <input class="form-control" id="slug" name="slug" type="text">
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="is_active">وضعیت</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="tag_ids">تگ</label>
                                    <select id="tagSelect" name="tag_ids[]" class="form-control" multiple
                                        data-live-search="true">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="text">توضیحات: </label>
                                    <div class="d-flex justify-content-center">
                                    <textarea class="form-control rounded-0 " id="basic-conf" name="description" rows="3" id="text" type="text">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                {{-- eduCourse Image Section --}}
                                <div class="col-md-12">
                                    <hr>
                                    <p>تصویر اصلی دوره آموزشی : </p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="file-upload form-group col-md-6 ">

                                        <button id="file-upload-btn1" class="file-upload-btn btn btn-success" type="button"
                                            onclick="$('#primary_image').trigger( 'click' )">انتخاب تصویر اصلی</button>

                                        <div id="image-primary-upload-wrap" class="image-upload-wrap ">
                                            <input class="file-upload-input" type="file" onchange="readURL(this);"
                                                accept="image/*" name="primary_image" id="primary_image" />
                                            <div id="primary_img"></div>
                                            <div class="drag-text text-dark">
                                                <h3> یک تصویر را بکشید و رها کنید یا انتخاب تصویر اصلی را بزنید</h3>
                                            </div>
                                        </div>
                                        <div id="file-upload-image-content" class="file-upload-content">
                                            <h5> <b> تصویر اصلی </b> </h5>
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
                                <div class="d-flex justify-content-center">
                                <div class="form-group form-input-video-group col-md-8">
                                    <div class="input-group">

                                        <div class="input-group-btn">
                                            <span class="fileUpload btn btn-success ">
                                                <span class="upl" id="upload">آپلود فایل
                                                    ویدئویی پیش نمایش دوره</span>
                                                <input type="file" class="upload up" id="up"
                                                    onchange="readVideoURL(this);" accept="video/mp4"
                                                    name="primary_video"/>

                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-input-video-control"
                                            readonly>
                                    </div>
                                </div>
                                </div>

                                {{-- Category&Attributes Section --}}
                                <div class="col-md-12">
                                    <hr>
                                    <p>دسته بندی و ویژگی ها : </p>
                                </div>

                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-3">
                                            <label for="category_id">دسته بندی</label>
                                            <select id="categorySelect" name="category_id" class="form-control"
                                                data-live-search="true">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }} -
                                                        {{ $category->parent->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="attributesContainer" class="col-md-12">
                                    <div id="attributes" class="row"></div>
                                    <div class="col-md-12">
                                        <hr>
                                        <p>افزودن ویدئو برای دوره <span class="font-weight-bold" id="variationName"></span>
                                            :
                                        </p>
                                    </div>

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
                                                                            name="movie_download_link[]"  id="userImage" />

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
                                </div>

                                {{-- Delivery Section --}}
                                <div class="col-md-12">
                                    <hr>
                                    <p>هزینه ها : </p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="delivery_amount">هزینه دوره</label>
                                    <input class="form-control" id="delivery_amount" name="price" type="text"
                                        value="{{ old('price') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="delivery_amount">هزینه ارسال</label>
                                    <input class="form-control" id="delivery_amount" name="delivery_amount" type="text"
                                        value="{{ old('delivery_amount') }}">
                                </div>
                            </div>
                            <button id="send" class="btn btn-success mt-4 mb-5" type="submit">ثبت</button>
                            <a href="{{ route('admin.courses.index') }}"
                                class="btn btn-secondary mt-4 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript-code')
    <script>
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });

        // Show File Name
        $('#primary_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        $('#attributesContainer').hide();

        $('#categorySelect').on('changed.bs.select', function() {
            let categoryId = $(this).val();

            $.get(`{{ url('/admin-panel/management/category-attributes/${categoryId}') }}`, function(response,
                status) {
                if (status == 'success') {
                    // console.log(response);

                    $('#attributesContainer').fadeIn();

                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attributes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3 mt-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });

                    $('#variationName').text(response.variation.name);

                } else {
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function() {
                alert('مشکل در دریافت لیست ویژگی ها');
            })

            // console.log(categoryId);
        });

        $("#czContainer").czMore();
    </script>

    <script>
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
            $('#file-upload-image-content').hide();
            $('#image-primary-upload-wrap').show();
            $('#file-upload-btn1').show();
        }
        $('#image-primary-upload-wrap').bind('dragover', function() {
            $('#image-primary-upload-wrap').addClass('image-dropping');
        });
        $('#image-primary-upload-wrap').bind('dragleave', function() {
            $('#image-primary-upload-wrap').removeClass('image-dropping');
        });
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
    {{-- <script>

$(document).ready(function() {
    $('#uploadForm').submit(function(e) {
        if($('#userImage').val()) {
            e.preventDefault();
            $('#loader-icon').show();
            $(this).ajaxSubmit({
                target:   '#targetLayer',
                beforeSubmit: function() {
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                success:function (){
                    $('#loader-icon').hide();
                },
                resetForm: true
            });
            return false;
        }
    });
});
    </script> --}}
@endsection
