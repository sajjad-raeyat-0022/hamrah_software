@extends('home.layouts.home')

@section('title')
    خانه
@endsection


@section('content')
    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="content">
            <h1>در خانه بیاموزید</h1>
            <p>همراه سافتور، با برنامه دقیق و بارگذاری دوره های به روز شما را تا انتهای مسیر موفقیت همراهی می کند.
            <form action="{{ route('home.courses.all-courses') }}" method="get">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="دنبال چه دوره ای هستی؟!">

                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary input-group-text cursor-pointer rounded-5" ><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="box-container">
            @foreach ($indexTopBanners->chunk(3)->first() as $banner)
                <div class="box">
                    {{-- <a href="#"><img class="" style="height: 80px; width:80px;" src="{{ asset(env('BANNER_IMAGES_UPLOAD_PATH') .$banner->image) }}" alt="{{ $banner->image }}"></a> --}}
                    <a href="@php
                              if ($banner->button_link != null) {
                                  if ($banner->button_link == 'home.courses.all-courses.coupon') {
                                    echo '/courses/all?coupon=true';
                                  }
                                  else if($banner->button_link == 'home.courses.all-courses.popular'){
                                    echo '/courses/all?popular=true';
                                  }
                                  else {
                                    echo $banner->button_link .'?banner=' .$banner->id;
                                  }
                              }else {
                                echo 'banner-show' .'?banner=' .$banner->id;
                              }
                            @endphp">
                        <i class="{{ $banner->button_icon }}"></i>
                        <h3>{{ $banner->title }}</h3>
                    </a>
                    <p>
                        @php
                            echo $banner->button_text;
                        @endphp
                    </p>
                </div>
            @endforeach
        </div>

    </section>

    <div id="course"></div>
    <br>
    <section  class="course">

        <h1 class="heading">دسته بندی ها</h1>
        <h3 class="title">مهارت های خود را با جدیدترین دوره ها ارتقا دهید</h3>


        <div class="box-container">
            @php
                $parentCategories = App\Models\Category::where('parent_id', 0)->get();
            @endphp
            @foreach ($parentCategories as $parentCategory)

                @foreach ($parentCategory->children as $childCategory)
                    <div class="box">
                        <i class="{{ $childCategory->icon == null ? 'fas fa-book' : $childCategory->icon }}"></i>
                        <a href="{{ route('home.categories.show', ['category' => $childCategory->slug]) }}">
                            <h3>{{ $childCategory->name }}</h3>
                        </a>
                        <p>{{ $childCategory->description }}</p>
                        {{-- <a href="#" class="text-center"><button class="btn btn-primary">مشاهده</button></a> --}}
                    </div>
                @endforeach

            @endforeach
        </div>
        <div class="container text-center">
            <a href="{{ route('home.courses.all-courses') }}"><button class="btn btn-danger">مشاهده همه دوره های
                    آموزشی</button></a>
    </section>

    <div id="new_course"></div>
    <br>
    <section class="py-4 review" dir="ltr">
        <h1 class="heading">جدید ترین دوره ها</h1>
        <div class="container">

            <div class="tab-content pt-3 review container">
                <div class="new-arrivals owl-carousel owl-theme show" id="all-course" role="tabpanel">
                    <div class="box-container ">
                        @php
                            $now = Carbon\Carbon::now();
                        @endphp
                        @foreach ($courses as $course)
                            @include('home.partials.course-information')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <div id="review"></div>
        <h1 class="heading">آموزش های دیگر</h1>
        <h3 class="title">دوره های آموزش از راه دور ما</h3>
        <div class="box-container">
            @foreach ($indexBottomBanners->chunk(4)->first() as $banner)
                <div class="box">
                    <a href="{{ $banner->button_link == null ? 'banner-show' : $banner->button_link }}{{ '?banner=' .$banner->id }}"><img class="" style="height: 80px; width:80px;"
                            src="{{ asset(env('BANNER_IMAGES_UPLOAD_PATH') . $banner->image) }}"
                            alt="{{ $banner->image }}"></a>
                    {{-- <i class="fas fa-graduation-cap"></i> --}}
                    <h3>{{ $banner->title }}</h3>
                    <p>
                        {{ $banner->button_text }}
                    </p>
                    <a href="{{ $banner->button_link == null ? 'banner-show' : $banner->button_link }}{{ '?banner=' .$banner->id }}"><button
                            class="btn btn-danger">مشاهده</button></a>
                </div>
            @endforeach
        </div>
    </section>

@endsection

