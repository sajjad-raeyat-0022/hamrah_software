@extends('home.layouts.home')

@section('title')
    خانه
@endsection

@section('content')
    <section class="review">
        <br><br>
        <h1 class="heading">{{ $banner_info->title }}</h1>
        <br>
        {{-- <h3 class="title"> دوره‌های آموزش از راه دور </h3> --}}
        <div class="container">
            <div class="banner-detail-card">
                <div class="banner-detail-body">
                    <div class="row g-0">
                        <div class="col-12 col-lg-7">
                            <div class="banner-info-section " dir="rtl">
                                <div class="mt-3">
                                    <b>توضیحات :</b>
                                    <br>
                                    @php
                                        echo $banner_info->text;
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="image-zoom-section ">
                                <div class="banner-gallery  border mb-3 p-3">
                                    <div id="pro-primary-{{ $banner_info->id }}" class="item d-flex justify-content-center">
                                        <img src="{{ asset(env('BANNER_IMAGES_UPLOAD_PATH') . $banner_info->image) }}"
                                            class="img-fluid" style="height: 350px; width:450px"
                                            alt="{{ $banner_info->image }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <br><br>
    </section>

@endsection
