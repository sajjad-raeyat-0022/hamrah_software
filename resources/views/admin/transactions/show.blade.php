@extends('admin.layouts.admin')

@section('title')
    تراکنش
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">تراکنش شماره : {{ $transaction->order_id }}</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 mt-3">
                                <label>نام کاربر</label>
                                <input class="form-control" type="text"
                                    value="{{ $transaction->user->name == null ? 'کاربر' : $transaction->user->name }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label>وضعیت</label>
                                <input class="form-control" type="text" value="{{ $transaction->status }}" disabled>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label>مبلغ</label>
                                <input class="form-control" type="text" value="{{ $transaction->amount }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>نام درگاه پرداخت</label>
                                <input class="form-control" type="text" value="{{ $transaction->gateway_name }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ref_id</label>
                                <input class="form-control" type="text" value="{{ $transaction->ref_id }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تاریخ ایجاد</label>
                                <input class="form-control" type="text" value="{{ verta($transaction->created_at) }}" disabled>
                            </div>
                        </div>
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary mt-3 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
        </section>
    </div>
@endsection
