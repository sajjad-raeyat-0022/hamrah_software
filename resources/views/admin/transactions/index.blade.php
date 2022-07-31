@extends('admin.layouts.admin')

@section('title')
     تراکنش ها
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
                            <h5 class="font-weight-bold">تراکنش ها ({{ $transactions->total() }})</h5>
                            {{-- <a class="btn btn-sm btn-success" href="{{ route('admin.transactions.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد تراکنش برای یک کاربر
                            </a> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center table-secondary">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام کاربر</th>
                                        <th>شماره سفارش</th>
                                        <th>مبلغ</th>
                                        <th>ref_id</th>
                                        <th>نام درگاه پرداخت</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                        <tr>
                                            <th>
                                                {{ $transactions->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $transaction->user->name == null ? 'کاربر' : $transaction->user->name }}
                                            </th>
                                            <th>
                                                {{ $transaction->order_id }}
                                            </th>
                                            <th>
                                                {{ number_format($transaction->amount) }}
                                            </th>
                                            <th>
                                                {{ $transaction->ref_id }}
                                            </th>
                                            <th>
                                                {{ $transaction->gateway_name }}
                                            </th>
                                            <th class="{{ $transaction->status == 'ناموفق' ? 'text-danger' : 'text-success' }}">
                                                {{ $transaction->status }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold"
                                                    href="{{ route('admin.transactions.show', ['transaction' => $transaction->id]) }}">نمایش</a>
                                                {{-- <a class="btn btn-sm btn-outline-warning mr-3"
                                                    href="{{ route('admin.transactions.edit', ['transaction' => $transaction->id]) }}">ویرایش</a> --}}
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $transactions->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $attributes->fragment('attributes')->links() }} --}}
                    {{-- {{ $attributes->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
