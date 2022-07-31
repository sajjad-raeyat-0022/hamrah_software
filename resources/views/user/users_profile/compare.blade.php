@extends('user.layouts.user')

@section('title')
    مقایسه دوره
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">مقایسه دوره ها</h4>
                        </div>
                        <div class="col-md-12 mt-3">
                        @if (!session()->has('compareCourses' .'-' .auth()->id()))
                            <div class="alert alert-danger">
                                هیچ دوره ای برای مقایسه وارد نشده است
                            </div>
                        @else
                            <div class="compare-page-content-wrap">
                                <div class="compare-table table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="first-column text-center text-bold"> دوره </td>
                                                @foreach ($courses as $course)
                                                <td class="course-image-title text-center">
                                                    <a href="{{ route('home.courses.show', ['course' => $course->slug]) }}" class="image">
                                                        <img width="150" class="img-fluid" src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"
                                                            alt="Compare Course">
                                                    </a>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> نام </td>
                                                @foreach ($courses as $course)
                                                <td class="pro-name">
                                                    <p class="text-center">
                                                        <a href="{{ route('home.courses.show', ['course' => $course->slug]) }}" class="title"> {{ $course->name }} </a>
                                                    </p>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> دسته بندی </td>
                                                @foreach ($courses as $course)
                                                <td class="pro-name">
                                                    <p class="text-center">
                                                        <a href="{{ route('home.categories.show' , ['category' => $course->category->slug ]) }}" class="category"> {{ $course->category->name }} </a>
                                                    </p>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> توضیحات </td>
                                                @foreach ($courses as $course)
                                                <td class="pro-desc">
                                                    <p class="text-right">
                                                        @php
                                                            echo $course->description;
                                                        @endphp
                                                    </p>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> ویژگی ها </td>
                                                @foreach ($courses as $course)
                                                <td>
                                                    <ul class="text-right">
                                                        @foreach ($course->attributes()->with('attribute')->get() as $attribute)
                                                        <li>
                                                            {{ $attribute->attribute->name }}
                                                            :
                                                            {{ $attribute->value }}
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> قیمت </td>
                                                @foreach ($courses as $course)
                                                <td>
                                                    @php
                                                        $now = Carbon\Carbon::now();
                                                        $sale_price_check = null;
                                                        if ($course->sale_price != null && $course->date_on_sale_from < $now && $course->date_on_sale_to > $now) {
                                                            $sale_price_check = true;
                                                        } else {
                                                            $sale_price_check = false;
                                                        }
                                                    @endphp
                                                    <div class="price d-flex justify-content-center mx-3 ">
                                                        @if ($sale_price_check)
                                                            <span
                                                                class="me-1 text-muted text-decoration-line-through">{{ $course->price != null ? number_format($course->price) : رایگان }}
                                                                تومان</span>
                                                            <b><span class="text-danger fs-5">{{ number_format($course->sale_price) }}
                                                                    تومان</span></b>
                                                        @else
                                                            <b><span class="text-danger fs-5">{{ $course->price != null ? number_format($course->price) : رایگان }}
                                                                    تومان</span></b>
                                                        @endif
                                                    </div>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> امتیاز </td>
                                                @foreach ($courses as $course)
                                                <td>
                                                    <div class="text-center" data-rating-stars="5" data-rating-readonly="true"
                                                        data-rating-value="{{ ceil($course->rates->avg('rate')) }}">
                                                    </div>
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="first-column text-center text-bold"> حذف </td>
                                                @foreach ($courses as $course)
                                                    <td class="pro-remove text-center">
                                                        <a href="{{ route('home.compare.remove' , ['course' => $course->id]) }}"><i class="fas fa-trash fa-lg text-danger"></i></a>
                                                    </td>
                                                @endforeach

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
