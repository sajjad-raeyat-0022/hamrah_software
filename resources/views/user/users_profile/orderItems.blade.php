@extends('user.layouts.user')

@section('title')
    دوره های من
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">دوره های من</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="myaccount-table table-responsive">
                                @if ($orders->isEmpty())
                                    <div class="alert alert-danger">
                                        شما هنوز هیچ دوره ای را خریداری نکرده اید.
                                    </div>
                                @else
                                    <table class="table table-bordered table-striped text-center table-secondary">
                                        <thead>
                                            <tr>
                                                <th> تصویر دوره </th>
                                                <th> نام دوره </th>
                                                <th> قیمت کل </th>
                                                <th> عملیات </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orders as $order)
                                            @if($order->status == 'پرداخت شده')
                                                @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td class="course-thumbnail">
                                                            <a
                                                                href="{{ route('home.courses.show', ['course' => $item->course->slug]) }}">
                                                                <img style="height: 70px; width:70px;"
                                                                    src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $item->course->primary_image) }}"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td class="course-name"><a
                                                                href="{{ route('home.courses.show', ['course' => $item->course->slug]) }}">
                                                                {{ $item->course->name }} </a></td>
                                                        <td class="course-subtotal">
                                                            {{ number_format($item->sum) }}
                                                            تومان
                                                            <br>
                                                            @if ($item->course->is_sale)
                                                                <b style="font-size: 12px ; color:red">
                                                                    {{ $item->course->persent_sale }}%
                                                                    تخفیف
                                                                </b>
                                                            @endif
                                                        </td>
                                                        <th>
                                                            <a class="btn btn-sm btn-outline-info text-bold"
                                                                href="{{ route('user.users_profile.orderItemsMovie', ['course' => $item->course]) }}">مشاهده فیلم ها</a>
                                                            @php
                                                                $b = 0;
                                                                foreach ($item->course->download_movie as $key => $movie){
                                                                $view = App\Models\Viewmovie::where('user_id',Auth::user()->id)->where('orderitem_id',$movie->id)->where('view',1)->first();

                                                                    if (empty($view)) {
                                                                        $b = 0;
                                                                    }
                                                                    else {
                                                                        $b += 1;
                                                                    }



                                                                }
                                                                $exam = App\Models\Exam::where('course_id',$item->course->id)->first();
                                                            @endphp
                                                            @if ($exam != null)

                                                                @if ($b > 0)

                                                                    @if($exam->getRawOriginal('is_active'))
                                                                    <a class="btn btn-sm btn-outline-warning text-bold mr-3"
                                                                        href="{{ route('user.exam.index', ['course' => $item->course->id]) }}">امتحان دادن</a>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </th>
                                                    </tr>

                                                @endforeach
                                                @endif
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
                {{ $orders->withQueryString()->onEachSide(2)->render() }}
            </div>

        </section>
    </div>
@endsection
