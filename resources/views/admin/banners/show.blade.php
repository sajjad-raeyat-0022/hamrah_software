@extends('admin.layouts.admin')

@section('title')
    نمایش بنر
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">
                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">بنر : {{ $banner->title }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>تصویر اصلی بنر : </h5>
                                <br>
                            </div>

                            <div class="container text-center d-flex justify-content-center mb-4">
                                <div class="col-md-5">
                                    <div class="card">
                                        <img class="card-img-top"
                                            src="{{ url(env('BANNER_IMAGES_UPLOAD_PATH') . $banner->image) }}"
                                            height="300" alt="{{ $banner->title }}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group col-md-4">
                                <label>عنوان</label>
                                <input class="form-control" type="text" value="{{ $banner->title }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>اولویت</label>
                                <input class="form-control" type="text" value="{{ $banner->priority }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>وضعیت</label>
                                <input class="form-control" type="text" value="{{ $banner->is_active }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>نوع بنر</label>
                                <input class="form-control" type="text" value="{{ $banner->type }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label>لینک دکمه</label>
                                <input class="form-control" type="text" value="{{ $banner->button_link }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label>آیکون دکمه</label>
                                <input class="form-control" type="text" value="{{ $banner->button_icon }}" disabled>
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label>متن نمایشی</label>
                                <textarea class="form-control" rows="5" disabled>{{ $banner->button_text }}</textarea>
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label>متن اصلی</label>
                                <textarea class="form-control" rows="5" disabled>@php
                                        echo $banner->text;
                                    @endphp</textarea>
                            </div>
                        </div>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary mt-3 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
