@extends('user.layouts.user')

@section('title')
    پروفایل کاربر
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">اطلاعات پروفایل</h4>

                        </div>
                        <div>
                            <div class="col-lg-12 col-md-12 mt-3">
                                <div class="tab-content" id="myaccountContent">

                                    @include('partials.errors')
                                    <div class="myaccount-content">
                                        <div class="account-details-form">
                                            <form action="{{ route('user.users_profile.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class=" col-md-4">
                                                        <div class="form-group">
                                                            <label for="first-name" class="required">
                                                                نام و نام خانوادگی
                                                            </label>
                                                            <input class="form-control" name="name" type="text"
                                                                id="first-name" value="{{ Auth::user()->name }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email" class="required"> ایمیل </label>
                                                            @if (Auth::user()->email == null)
                                                                <input class="form-control" name="email" type="email"
                                                                    id="email" />
                                                            @else
                                                                <input class="form-control" type="email" id="email"
                                                                    value="{{ Auth::user()->email }}" disabled />
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone_number" class="required"> شماره تلفن
                                                            </label>
                                                            @if (Auth::user()->phone_number == null)
                                                                <input class="form-control" name="phone_number"
                                                                    type="text" id="phone_number" />
                                                            @else
                                                                <input class="form-control" type="text" id="phone_number"
                                                                    value="{{ Auth::user()->phone_number }}" disabled />
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="file-upload form-group col-md-6 ">

                                                            <button id="file-upload-btn1"
                                                                class="file-upload-btn btn btn-success" type="button"
                                                                onclick="$('#profile_avatar').trigger( 'click' )">انتخاب
                                                                تصویر پروفایل</button>

                                                            <div id="image-primary-upload-wrap" class="image-upload-wrap ">
                                                                <input class="file-upload-input" type="file"
                                                                    onchange="readURL(this);" accept="image/*"
                                                                    name="profile_avatar" id="profile_avatar" />
                                                                <div id="primary_img"></div>
                                                                <div class="drag-text text-dark">
                                                                    <h3> یک تصویر را بکشید و رها کنید یا انتخاب تصویر
                                                                        پروفایل را بزنید</h3>
                                                                </div>
                                                            </div>
                                                            <div id="file-upload-image-content" class="file-upload-content">
                                                                <h5> <b> تصویر پروفایل </b> </h5>
                                                                <img id="file-upload-primary-image"
                                                                    class="file-upload-image" src="#" alt="your image" />
                                                                <div id="file-upload-image-wrap" class="image-title-wrap">
                                                                    <button type="button" onclick="removeUpload()"
                                                                        class="remove-image btn btn-danger ">حذف <span
                                                                            class="image-title">آپلود
                                                                            تصویر</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-success mx-3"> ثبت تغییرات </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@section('javascript-code')
    <script>
        $('#profile_avatar').change(function() {
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
            $('#profile_avatar').remove();
            $('#profile_avatar').replaceWith($('#primary_img').append(
                '<input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*" name="profile_avatar" id="profile_avatar"/>'
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
@endsection
