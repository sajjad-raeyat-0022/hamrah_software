@extends('user.layouts.user')

@section('title')
    سفارشات
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">لیست سفارشات</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="myaccount-table table-responsive">
                                @if ($orders->isEmpty())
                                    <div class="alert alert-danger">
                                        لیست سفارشات شما خالی می باشد
                                    </div>
                                @else
                                    <table class="table table-bordered table-striped text-center table-secondary">
                                        <thead class="thead-light">
                                            <tr>
                                                <th> سفارش </th>
                                                <th> تاریخ </th>
                                                <th> وضعیت </th>
                                                <th> نوع سفارش </th>
                                                <th> کد تخفیف </th>
                                                <th> جمع کل </th>
                                                <th> عملیات </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td> {{ verta($order->created_at)->format('%d %B، %Y') }}
                                                    </td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ $order->delivery_amount == 0 ? 'دریافت به صورت لینک مستقیم' : 'دریافت به صورت لینک مستقیم و ارسال درب منزل' }}
                                                    </td>
                                                    <td class="text-danger">
                                                        {{ $order->coupon_amount != 0 ? number_format($order->coupon_amount) . 'تومان ' : 'کد تخفیفی اعمال نشده ' }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($order->paying_amount) }}
                                                        تومان
                                                    </td>
                                                    <td><a href="#" data-toggle="modal"
                                                            data-target="#ordersDetiles-{{ $order->id }}"
                                                            class="btn btn-info text-bold "> نمایش جزئیات </a>
                                                    </td>
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
                {{ $orders->withQueryString()->onEachSide(2)->render() }}
            </div>
            @foreach ($orders as $order)
                <!-- Modal Order -->
                <div class="modal fade" id="ordersDetiles-{{ $order->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                                        <form action="#">
                                            <div class="table-content table-responsive cart-table-content">
                                                <table class="table table-bordered table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th> تصویر محصول </th>
                                                            <th> نام محصول </th>
                                                            <th> قیمت کل </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
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
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal end -->
            @endforeach

        </section>
    </div>
@endsection
{{-- @section('javascript-code')
<script>
   $(function() {
  $("#type_cart_.$item->id").click(function() {
    // validate and process form here
  });
});
</script>
@endsection --}}
