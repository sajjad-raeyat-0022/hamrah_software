@extends('admin.layouts.admin')

@section('title')
    سفارش
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">سفارش : {{ $order->name }}</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 mt-3">
                                <label>نام کاربر</label>
                                <input class="form-control" type="text"
                                    value="{{ $order->user->name == null ? 'کاربر' : $order->user->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-3">
                                <label>کد تخفیف</label>
                                <input class="form-control" type="text"
                                    value="{{ $order->coupon_id == null ? 'استفاده نشده' : $order->coupon->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-3">
                                <label>وضعیت</label>
                                <input class="form-control" type="text" value="{{ $order->status }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-3">
                                <label>مبلغ</label>
                                <input class="form-control" type="text" value="{{ $order->total_amount }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>هزینه ارسال</label>
                                <input class="form-control" type="text" value="{{ $order->delivery_amount }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>مبلغ کد تخفیف</label>
                                <input class="form-control" type="text" value="{{ $order->coupon_amount }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>مبلغ پرداختی</label>
                                <input class="form-control" type="text" value="{{ $order->paying_amount }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>نوع پرداخت</label>
                                <input class="form-control" type="text" value="{{ $order->payment_type }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>وضعیت پرداخت</label>
                                <input class="form-control" type="text" value="{{ $order->payment_status }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label>تاریخ ایجاد</label>
                                <input class="form-control" type="text" value="{{ verta($order->created_at) }}" disabled>
                            </div>

                            <div class="form-group col-md-12">
                                <label>آدرس</label>
                                <textarea class="form-control" disabled>{{ $order->address->address }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <h5>محصولات</h5>
                                <div class="table-responsive">
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
                                                        <a href="{{ route('admin.courses.show', ['course' => $item->course->id]) }}">
                                                            <img width="70"
                                                                src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $item->course->primary_image) }}"
                                                                alt="">
                                                        </a>
                                                    </td>
                                                    <td class="course-name"><a
                                                            href="{{ route('admin.courses.show', ['course' => $item->course->id]) }}">
                                                            {{ $item->course->name }} </a></td>
                                                    <td class="course-subtotal">
                                                        {{ number_format($item->sum) }}
                                                        تومان
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
        </section>
    </div>
@endsection
