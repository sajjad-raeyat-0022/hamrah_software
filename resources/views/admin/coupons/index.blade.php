@extends('admin.layouts.admin')

@section('title')
     کد های تخفیف
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
                            <h5 class="font-weight-bold">کد های تخفیف ({{ $coupons->total() }})</h5>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.coupons.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد کد تخفیف
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center table-secondary">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>کد</th>
                                        <th>نوع</th>
                                        <th>تاریخ انقضا</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $key => $coupon)
                                        <tr>
                                            <th>
                                                {{ $coupons->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $coupon->name }}
                                            </th>
                                            <th>
                                                {{ $coupon->code }}
                                            </th>
                                            <th>
                                                {{ $coupon->type }}
                                            </th>
                                            <th>
                                                {{ verta($coupon->expired_at) }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-success text-bold"
                                                    href="{{ route('admin.coupons.show', ['coupon' => $coupon->id]) }}">نمایش</a>
                                                <a class="btn btn-sm btn-outline-warning mr-3 text-bold"
                                                    href="{{ route('admin.coupons.edit', ['coupon' => $coupon->id]) }}">ویرایش</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $coupons->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $attributes->fragment('attributes')->links() }} --}}
                    {{-- {{ $attributes->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
