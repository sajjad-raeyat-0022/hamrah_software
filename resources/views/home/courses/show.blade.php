@extends('home.layouts.home')

@section('title')
    دوره آموزشی
@endsection

@section('content')

    <section class="review">
        <br><br>

        <h1 class="heading">{{ $course->name }}</h1>
        <br>
        {{-- <h3 class="title"> دوره‌های آموزش از راه دور </h3> --}}
        <div class="container">
            <div class="course-detail-card">
                <div class="course-detail-body">
                    {{-- /////////////////////////////////////////////// --}}
                    <div class="row g-0">
                        <div class="col-12 col-lg-7">
                            @php
                                $now = Carbon\Carbon::now();
                            @endphp
                            <div class="course-info-section" dir="rtl">
                                <div class="mt-3">
                                    <b>توضیحات :</b>
                                    <p class="mb-4">
                                        @php
                                            echo $course->description;
                                        @endphp
                                    </p>
                                </div>
                                <dl class="row mt-3">
                                    <dt class="col-sm-3">
                                        <b>ویژگی ها :</b>
                                    </dt>
                                    <dd class="col-sm-9">
                                        <ul class="text-right">
                                            @foreach ($course->attributes()->with('attribute')->get() as $attribute)
                                                <li> {{ $attribute->attribute->name }} : {{ $attribute->value }}</li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                </dl>
                                @php
                                    $sale_price_check = null;
                                    if ($course->sale_price != null && $course->date_on_sale_from < $now && $course->date_on_sale_to > $now) {
                                        $sale_price_check = true;
                                    } else {
                                        $sale_price_check = false;
                                    }
                                @endphp

                                <b>قیمت: </b>

                                <div class="price d-flex justify-content-start">
                                    @if ($sale_price_check)
                                    <span
                                            class="me-1 text-muted text-decoration-line-through">{{ number_format($course->price) != 0 ? number_format($course->price) . 'تومان' : 'رایگان' }}
                                        </span>
                                        <b><span class="text-danger fs-5">{{ number_format($course->sale_price) }}
                                                تومان</span></b>
                                    @else
                                        <b><span class="text-danger fs-5">{{ number_format($course->price) != 0 ? number_format($course->price) . 'تومان' : 'رایگان' }}
                                            </span></b>
                                    @endif
                                </div>
                                <div class="box">

                                    <div class="stars mx-2">
                                        <div class="mt-4">
                                            <b>امتیاز :</b>
                                        </div>
                                        <div class="mx-2">
                                            <br>
                                            <div data-rating-stars="5" data-rating-readonly="true"
                                                data-rating-value="{{ ceil($course->rates->avg('rate')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <dl class="mt-3">
                                    <b class="">دسته بندی محصولات :
                                        <a href="#" class="text-primary">{{ $course->category->parent->name }} ،
                                            {{ $course->category->name }}</a>
                                    </b>
                                </dl>
                                <dl class="mt-3">
                                    <b class="">تگ ها :
                                        @foreach ($course->tags as $tag)
                                            <a href="#" class="text-primary">{{ $tag->name }}
                                                {{ $loop->last ? '' : '،' }}</a>
                                        @endforeach
                                    </b>
                                </dl>
                                <div class="d-flex gap-2 mt-5 pro-details-quality">
                                    @php
                                        $bool = false;

                                        if (!empty($orders)) {
                                            foreach ($orders as $order) {
                                                foreach ($order->orderItems as $item) {
                                                    if ($item->course_id == $course->id) {
                                                        $bool = true;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    @if (!$bool)
                                    <form action="{{ route('home.cart.add') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <button type="submit" class="btn btn-success btn-ecomm p-4 mx-3"><i
                                                class="fas fa-shopping-cart"></i> افزودن به سبد خرید <i
                                                class="bx bxs-cart-add"></i></button>
                                    </form>
                                    @endif

                                    <div class="mt-3 mx-2">
                                        @auth
                                            @if ($course->checkUserFavoritelist(auth()->id()))
                                                <span>در لیست علاقه مندی ها وجود دارد</span>
                                                <a class=" mx-3 "
                                                    href="{{ route('home.favoritelist.remove', ['course' => $course->id]) }}"><i
                                                        class="fas fa-heart fa-lg" style="color: red"></i></a>

                                            @else
                                                <span>افزودن به لیست علاقه مندی ها</span>
                                                <a class=" mx-3"
                                                    href="{{ route('home.favoritelist.add', ['course' => $course->id]) }}"><i
                                                        class="far fa-heart fa-lg"></i></a>
                                            @endif
                                        @else
                                            <span>افزودن به لیست علاقه مندی ها</span>
                                            <a class=" mx-3"
                                                href="{{ route('home.favoritelist.add', ['course' => $course->id]) }}"><i
                                                    class="far fa-heart fa-lg"></i></a>
                                        @endauth
                                    </div>
                                    <div class="mt-3">
                                        <span>افزودن به لیست مقایسه دوره ها</span>
                                            <a class=" mx-3" href="{{ route('home.compare.add', ['course' => $course]) }}"><i class="fas fa-sync-alt fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="image-zoom-section ">
                                <div class="course-gallery">
                                    <div id="pro-primary-{{ $course->id }}" class="item d-flex justify-content-center">
                                        <video controls style="height: 350px; width:400px"
                                            poster="{{ url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"">
                                                                                    <source src="
                                            {{ url(env('EDU_COURSE_MOVIES_UPLOAD_PATH') . $course->primary_video) }}"
                                            type="video/mp4">
                                            </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <hr>
                            <a class="btn btn-outline-dark text-warning text-bold">فیلم های دوره</a>
                            <hr>
                        </div>

                        @if (!$bool)

                            <div class="container cart-empty-content">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <i class="sli sli-basket"></i>
                                        <div class="alert alert-danger">
                                            برای مشاهده لینک های دوره ابتدا باید دوره را خریداری کنید.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                        @foreach ($course->download_movie as $key => $movie)
                        <div class="col-md-12">
                            <div class="container text-center">
                                <div class="bd-highlight ms-auto">
                                    <p class="mb-0 ml-3">{{ $movie->movie_name }}: </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="mb-0 mr-3">
                                        <button class="btn btn-sm btn-danger mr-2 " type="button"
                                            data-toggle="collapse" data-target="#collapse-{{ $movie->id }}">
                                            نمایش به صورت آنلاین </button>
                                        <a href="{{ url(env('EDU_COURSE_MOVIES_UPLOAD_PATH') . $movie->movie_download_link) }}" target="_blank"><button class="btn btn-sm btn-danger mr-2 "
                                                type="button">
                                                دانلود با لینک مستقیم </button></a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="collapse mt-2 mb-4" id="collapse-{{ $movie->id }}">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        @endif
                    </div>
                    {{-- //////////////////////////////////// --}}
                    <section class="py-4 mb-5">
                        <div class="container">
                            <div class="course-more-info">
                                <ul class="nav nav-tabs mb-0" role="tablist">

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-toggle="tab"
                                            href="#reviews" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-title text-uppercase fw-500">دیدگاه
                                                    ({{ $course->approvedComments()->count() }})</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content pt-3 mx-3 mt-3">

                                    <div class="tab-pane active show" id="reviews"
                                        role="tabpanel">
                                        <div class="row">
                                            <div class="col col-lg-8">
                                                <div class="course-review">
                                                    <h5 class="mb-4">دیدگاه های این دوره</h5>
                                                    <div class="review-list">
                                                        @foreach ($course->approvedComments as $comment)
                                                            <div class="d-flex align-items-start">
                                                                <div class="review-user">
                                                                    <img src="@php
                                                                            if($comment->user->avatar == null){
                                                                                echo '/img/2730042.png';
                                                                            }
                                                                            elseif($comment->user->provider == 'google'){
                                                                                echo $comment->user->avatar;
                                                                            }else{
                                                                                echo '/laravel/public' .$comment->user->avatar;
                                                                            }
                                                                            @endphp"
                                                                        style="height: 65px; width:65px;"
                                                                        class="rounded-circle mx-3" alt="" />
                                                                </div>
                                                                <div class="review-content ms-3">

                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <h5 class="mb-0 text-danger text-bold">
                                                                            {{ $comment->user->name == null ? 'کاربر شماره ' . $comment->user->id : $comment->user->name }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="ht-course-ratting-wrap mt-2">
                                                                        <div data-rating-stars="5"
                                                                            data-rating-readonly="true"
                                                                            data-rating-value="{{ ceil($comment->user->rates->where('course_id', $course->id)->avg('rate')) }}">
                                                                        </div>
                                                                    </div>
                                                                    <p>{{ $comment->text }}</p>
                                                                </div>
                                                            </div>
                                                             @php
                                                                $comm = App\Models\Comment::where('answer_to',$comment->user->id)->where('course_id',$course->id)->first();
                                                                // dd($comm);
                                                            @endphp
                                                            @if ($comm != null)
                                                            <div class="d-flex align-items-start mx-5">
                                                                <div class="review-user">
                                                                    <img src="{{ asset('/img/back-arrow.png') }}"
                                                                        style="height: 25px; width:25px;"
                                                                        class="mx-3 mt-4" alt="" />
                                                                </div>
                                                                <div class="review-user">
                                                                    <img src="@php
                                                                            if($comm->user->avatar == null){
                                                                                echo '/img/2730042.png';
                                                                            }
                                                                            elseif($comm->user->provider == 'google'){
                                                                                echo $comm->user->avatar;
                                                                            }else{
                                                                                echo '/laravel/public' .$comm->user->avatar;
                                                                            }
                                                                            @endphp"
                                                                        style="height: 65px; width:65px;"
                                                                        class="rounded-circle mx-3 mt-4" alt="" />
                                                                </div>
                                                                <div class="review-content ms-3">
                                                                    <h5><b>پاسخ: </b></h5>
                                                                    <div class="d-flex align-items-center mb-2">
                                                                        <h5 class="mb-0 text-danger text-bold">
                                                                            {{ $comm->user->name == null ? 'کاربر شماره ' . $comm->user->id : $comm->user->name }}
                                                                        </h5>
                                                                    </div>
                                                                    <p>{{ $comm->text }}</p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <hr />
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-lg-4">
                                                <div id="comments" class="add-review bg-dark-1">
                                                    <div class="form-body p-3">
                                                        <h4 class="mb-4">نوشتن دیدگاه</h4>
                                                        @include('partials.errors')
                                                        <div class="mb-3">
                                                            <label class="form-label">امتیاز دهی</label>
                                                            <div class="ht-course-ratting-wrap mt-1">
                                                                <div data-rating-stars="5" data-rating-value="0"
                                                                    data-rating-input="#rateInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form
                                                            action="{{ route('home.comments.store', ['course' => $course->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label">متن دیدگاه</label>
                                                                <textarea class="form-control rounded-0" name="text"
                                                                    rows="3"></textarea>
                                                            </div>
                                                            <input id="rateInput" type="hidden" name="rate" value="0">
                                                            <div class="d-grid">
                                                                <button type="submit" type="button"
                                                                    class="btn btn-info btn-ecomm">ارسال دیدگاه</button>
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
            </div>
        </div>
    </section>

@endsection
