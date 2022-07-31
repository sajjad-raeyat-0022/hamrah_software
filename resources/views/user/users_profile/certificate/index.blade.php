@extends('user.layouts.user')

@section('title')
    نمرات و مدارک دوره ها
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">نمرات و مدارک دوره ها</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="myaccount-table table-responsive">
                                @if ($scores->isEmpty())
                                    <div class="alert alert-danger">
                                        شما هنوز در هیچ امتحان دوره ای شرکت نکرده اید.
                                    </div>
                                @else
                                    <table class="table table-bordered table-striped text-center table-secondary">
                                        <thead>
                                            <tr>
                                                <th> تصویر دوره </th>
                                                <th> نام دوره </th>
                                                <th> نمره کسب شده در امتحان </th>
                                                <th> دفعات شرکت در امتحان </th>
                                                <th> تاریخ اتمام دوره </th>
                                                <th> عملیات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($scores as $score)

                                                    <tr>
                                                        <td class="course-thumbnail">
                                                            <a
                                                                href="{{ route('home.courses.show', ['course' => $score->course->slug]) }}">
                                                                <img style="height: 70px; width:70px;"
                                                                    src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $score->course->primary_image) }}"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td class="course-name"><a
                                                                href="{{ route('home.courses.show', ['course' => $score->course->slug]) }}">
                                                                {{ $score->course->name }} </a></td>

                                                        <td class="course-subtotal">
                                                            {{ $score->total_grade .' از ' .$score->exam->final_grade }}
                                                        </td>
                                                        <td class="course-subtotal">
                                                            {{  $score->exam_visit }}
                                                        </td>
                                                        <td class="course-subtotal">
                                                            {{ verta($score->updated_at) }}
                                                        </td>
                                                        <th>
                                                            @if ($score->total_grade > $score->exam->final_grade/2)
                                                            <a href="{{ route('user.certificate.show',['score' => $score->id]) }}" class="btn btn-outline-info text-bold"> دریافت مدرک </a>
                                                            @else
                                                            <a class="btn btn-danger text-bold" disabled> شما موفق به دریافت مدرک این دوره نشده اید </a>
                                                            @endif
                                                        </th>
                                                    </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                {{ $scores->withQueryString()->onEachSide(2)->render() }}
            </div>

        </section>
    </div>
@endsection
