@extends('user.layouts.user')

@section('title')
    دوره های من
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">دوره : {{ $course->name }}</h5>
                        </div>
                        @foreach ($course->download_movie as $key => $movie)
                        @php
                            $view = App\Models\Viewmovie::where('user_id',auth()->user()->id)->where('orderitem_id',$movie->id)->where('view',1)->first();
                        @endphp
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between mt-3">
                                    <div class="bd-highlight ms-auto">
                                        <p class="mb-0 ml-3">{{ $movie->movie_name }}: </p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                            data-target="#collapse-{{ $movie->id }}">
                                            نمایش به صورت آنلاین </button>
                                        <a href="{{ url(env('EDU_COURSE_MOVIES_UPLOAD_PATH') . $movie->movie_download_link) }}"
                                            target="_blank"><button class="btn btn-primary mx-2 " type="button">
                                                دانلود با لینک مستقیم </button></a>

                                            <form action="{{ route('user.users_profile.orderItemsMovie.add_view',['movie' => $movie]) }}" method="post" class="mx-5">
                                            @csrf
                                            @if (!empty($view))
                                                <button type="submit" class="btn {{ $view->view == 0 ? 'btn-success' : 'btn-warning' }} mx-5"  {{ $view->view == 1 ? 'disabled' : '' }}>{{ $view->view == 0 ? 'ثبت مشاهده' : 'مشاهده شده' }}</button>
                                            @else
                                                <button type="submit" class="btn btn-success mx-5" >ثبت مشاهده</button>
                                            @endif
                                            </form>

                                    </div>
                                </div>
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

                        <a href="{{ route('user.users_profile.orderItems') }}" class="btn btn-secondary mt-5 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
