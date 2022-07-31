@extends('user.layouts.user')

@section('title')
    علاقه مندی ها
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">لیست علاقه مندی ها </h4>
                        </div>

                        <div class="col-md-12 mt-3">

                            @if ($favoritelist->isEmpty())
                                <div class="alert alert-danger">
                                    لیست علاقه مندی های شما خالی می باشد
                                </div>
                                <div class="container text-center">
                                    <div class="col-md-10">
                                        <img src="/img/empty-wishlist.png" style="height: 275px; width:400px;" alt="empty">
                                    </div>
                                </div>
                            @else
                                <div class="table-content table-responsive cart-table-content">
                                    <table class="table table-bordered table-striped text-center table-secondary">
                                        <thead>
                                            <tr>
                                                <th> تصویر محصول </th>
                                                <th> نام محصول </th>
                                                <th> حذف </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($favoritelist as $item)
                                                <tr>
                                                    <td class="course-thumbnail">
                                                        <a
                                                            href="{{ route('home.courses.show', ['course' => $item->course->slug]) }}">
                                                            <img style="height: 80px; width:80px;"
                                                                src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $item->course->primary_image) }}"
                                                                alt="{{ $item->course->primary_image }}">
                                                        </a>
                                                    </td>
                                                    <td class="course-name">
                                                        <a
                                                            href="{{ route('home.courses.show', ['course' => $item->course->slug]) }}">
                                                            <p class="mt-5 text-bold">{{ $item->course->name }}</p>
                                                        </a>
                                                    </td>
                                                    <td class="course-name">
                                                        <a
                                                            href="{{ route('home.favoritelist.remove', ['course' => $item->course->id]) }}">
                                                            <i class="fas fa-trash fa-lg mt-5 text-danger"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
