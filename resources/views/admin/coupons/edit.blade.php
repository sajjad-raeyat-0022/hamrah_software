@extends('admin.layouts.admin')

@section('title')
    ویرایش کد تخفیف
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش کد تخفیف : {{ $coupon->name }}</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.coupons.update',['coupon' => $coupon->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام</label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ $coupon->name }}" >
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="code">کد</label>
                                    <input class="form-control" id="code" name="code" type="text" value="{{ $coupon->code }}" >
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="type">نوع</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="amount" {{ $coupon->getTypeAttribute('type') ? 'selected' : '' }}>مبلغی</option>
                                        <option value="percentage" {{ $coupon->getTypeAttribute('type') ? '' : 'selected' }}>درصدی</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="amount">مبلغ</label>
                                    <input class="form-control" id="amount" name="amount" type="text" value="{{ $coupon->amount }}" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="percentage">درصد</label>
                                    <input class="form-control" id="percentage" name="percentage" type="text" value="{{ $coupon->percentage }}" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی</label>
                                    <input class="form-control" id="max_percentage_amount" name="max_percentage_amount" type="text" value="{{ $coupon->max_percentage_amount }}" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="max_percentage_amount">تاریخ انقضا</label>
                                    <div class="input-group">
                                        <div class="input-group-addon" data-mddatetimepicker="true"
                                            data-targetselector="#exampleInput1" data-trigger="click" data-enabletimepicker="true">
                                            <span><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="exampleInput1"
                                            name="expired_at"
                                            value="{{ verta($coupon->expired_at) }}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>توضیحات</label>
                                    <textarea class="form-control" rows="3" name="description" >{{ $coupon->description }}</textarea>
                                </div>
                            </div>

                            <button class="btn btn-warning mt-5 mb-5 mx-3" type="submit">ویرایش</button>
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('javascript-code')
    <script type="text/javascript">
        $('#input1').change(function() {
            var $this = $(this),
                value = $this.val();
            alert(value);
        });
        $('#textbox1').change(function() {
            var $this = $(this),
                value = $this.val();
            alert(value);
        });
        $('[data-name="disable-button"]').click(function() {
            $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable',
                true);
        });
        $('[data-name="enable-button"]').click(function() {
            $('[data-mddatetimepicker="true"][data-targetselector="#input1"]').MdPersianDateTimePicker('disable',
                false);
        });
    </script>

@endsection
