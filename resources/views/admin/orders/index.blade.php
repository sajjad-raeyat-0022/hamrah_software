@extends('admin.layouts.admin')

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
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="font-weight-bold">سفارشات ({{ $orders->total() }})</h5>
                            {{-- <a class="btn btn-sm btn-success" href="{{ route('admin.orders.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد سفارش برای یک کاربر
                            </a> --}}
                        </div>
                        <table class="table table-bordered table-striped text-center table-secondary">

                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام کاربر</th>
                                    <th>وضعیت</th>
                                    <th>مبلغ</th>
                                    <th>نوع پرداخت</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <th>
                                            {{ $orders->firstItem() + $key }}
                                        </th>
                                        <th>
                                            {{ $order->user->name == null ? 'کاربر' : $order->user->name }}
                                        </th>
                                        <th class="{{ $order->status == 'در انتظار پرداخت' ? 'text-warning' : 'text-success' }}">
                                            {{ $order->status }}
                                        </th>
                                        <th>
                                            {{ number_format($order->total_amount) }}
                                        </th>
                                        <th>
                                            {{ $order->payment_type }}
                                        </th>
                                        <th class="{{ $order->payment_status == 'ناموفق' ? 'text-danger' : 'text-success' }}">
                                            {{ $order->payment_status }}
                                        </th>
                                        <th>
                                            <a class="btn btn-sm btn-outline-info text-bold"
                                                href="{{ route('admin.orders.show', ['order' => $order->id]) }}">نمایش</a>
                                            {{-- <a class="btn btn-sm btn-outline-warning mr-3 text-bold"
                                                href="{{ route('admin.orders.edit', ['order' => $order->id]) }}">ویرایش</a> --}}
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $orders->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $attributes->fragment('attributes')->links() }} --}}
                    {{-- {{ $attributes->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
