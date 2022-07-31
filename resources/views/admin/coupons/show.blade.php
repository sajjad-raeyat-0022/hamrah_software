@extends('admin.layouts.admin')

@section('title')
     کد تخفیف
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">کد تخفیف : {{ $coupon->name }}</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 mt-2">
                                <label for="name">نام</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{ $coupon->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="code">کد</label>
                                <input class="form-control" id="code" name="code" type="text" value="{{ $coupon->code }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="type">نوع</label>

                                <input class="form-control" id="code" name="type" type="text" value="{{ $coupon->type }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-2">
                                <label for="amount">مبلغ</label>
                                <input class="form-control" id="amount" name="amount" type="text" value="{{ $coupon->amount }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="percentage">درصد</label>
                                <input class="form-control" id="percentage" name="percentage" type="text" value="{{ $coupon->percentage }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی</label>
                                <input class="form-control" id="max_percentage_amount" name="max_percentage_amount" type="text" value="{{ $coupon->max_percentage_amount }}" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label> تاریخ انقضا </label>
                                <input type="text"
                                    value="{{ verta($coupon->expired_at) }}"
                                    disabled class="form-control">
                            </div>
                            <div class="form-group col-md-3 mt-3">
                                <label>تاریخ ایجاد</label>
                                <input class="form-control" type="text" value="{{ verta($coupon->created_at) }}" disabled>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توضیحات</label>
                                <textarea class="form-control" rows="3" disabled>{{ $coupon->description }}</textarea>
                            </div>
                    </div>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary mt-3 mb-5 mx-3">بازگشت</a>
                </div>
            </div>
        </section>
    </div>
@endsection
