@extends('user.layouts.user')

@section('title')
    سبد خرید
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">سبد خرید</h4>
                        </div>
                            <div class=" col-md-12 mt-3">
                                @if (\Cart::session(auth()->id())->isEmpty())
                                    <div class="container cart-empty-content">
                                        <div class="row ">
                                            <div class="col-md-10">
                                                <i class="sli sli-basket"></i>
                                                <div class="alert alert-danger">
                                                سبد خرید شما خالی میباشد.
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <img src="/img/empty-cart.png" style="height: 200px; width: 350px;"
                                                        alt="empty">
                                                </div>
                                                <a href="{{ route('home.courses.all-courses') }}" class="btn btn-info">
                                                    مشاهده همه دوره ها و خرید </a>

                                            </div>

                                        </div>
                                    </div>
                                @else

                                    <div class="col-md-12">

                                        <form action="{{ route('user.users_profile.cart.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="table-content table-responsive cart-table-content col-md-12">
                                                <table class="table table-bordered table-striped text-center table-secondary">
                                                    <thead>
                                                        <tr>
                                                            <th> تصویر محصول </th>
                                                            <th> نام محصول </th>
                                                            <th> قیمت </th>
                                                            <th> عملیات </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (\Cart::session(auth()->id())->getContent() as $key => $item)
                                                            <tr>
                                                                <td class="course-thumbnail">
                                                                    <a
                                                                        href="{{ route('home.courses.show', ['course' => $item->associatedModel->slug]) }}">
                                                                        <img style="height: 80px; width:80px;"
                                                                            src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $item->associatedModel->primary_image) }}"
                                                                            alt="">
                                                                    </a>
                                                                </td>
                                                                <td class="course-name">
                                                                    <br>
                                                                    <a
                                                                        href="{{ route('home.courses.show', ['course' => $item->associatedModel->slug]) }}">
                                                                        {{ $item->name }} </a>
                                                                </td>


                                                                <td class="course-price-cart">
                                                                    <br>
                                                                    <span class="amount text-bold">
                                                                        {{ number_format($item->price) }}
                                                                        تومان
                                                                    </span>
                                                                    <br>
                                                                    @if ($item->associatedModel->is_sale)
                                                                        <b style="font-size: 12px ; color:red">
                                                                            {{ $item->associatedModel->persent_sale }}%
                                                                            تخفیف
                                                                        </b>
                                                                    @endif
                                                                </td>
                                                                <td class="course-remove">
                                                                    <a
                                                                        href="{{ route('user.users_profile.cart.remove', ['rowId' => $item->id]) }}"><i
                                                                            class="fas fa-trash fa-lg text-danger mt-4"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <p>توجه: نوع دریافت دوره را مشخص کرده </p>
                                                                <p>و بروز رسانی سبد خرید را بزنید: </p>
                                                                <input type="radio" name="type_cart[{{ $item->id }}]"
                                                                    value="1"
                                                                    {{ $item->type_cart == 1 ? 'checked' : '' }}>
                                                                <label for="type_cart1">دریافت به صورت لینک
                                                                    مستقیم
                                                                    دوره</label><br>
                                                                <input type="radio" name="type_cart[{{ $item->id }}]"
                                                                    value="2"
                                                                    {{ $item->type_cart == 2 ? 'checked' : '' }}>
                                                                <label for="type_cart2">دریافت درب منزل و لینک
                                                                    مستقیم</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                                    <div class="cart-shiping-update-wrapper">
                                                        <div class="cart-shiping-update text-center">
                                                            <a class="btn btn-info mt-2"
                                                                href="{{ route('home.courses.all-courses') }}">
                                                                افزودن دوره های دیگر به سبد خرید </a>

                                                            <button type="submit" class="btn btn-warning mt-2 mx-2"> به روز
                                                                رسانی
                                                                سبد خرید </button>
                                                            <a href="{{ route('user.users_profile.cart.clear') }}"
                                                                class="btn btn-danger mt-2" href="#"> حذف سبد
                                                                خرید </a>
                                                        </div>
                                                    </div>

                                        </form>

                                        <div class="row justify-content-between mt-5">

                                            <div class="col-lg-6 col-md-6">
                                                <div class="discount-code-wrapper">
                                                    <div class="title-wrap">
                                                        <h4 class="cart-bottom-title section-bg-gray">
                                                            کد تخفیف </h4>
                                                    </div>
                                                    <div class="discount-code">

                                                        <form action="{{ route('user.users_profile.cart.checkcoupon') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" required=""
                                                                    name="code">
                                                            </div>
                                                            <button class="btn btn-success" type="submit"> ثبت
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="grand-totall">
                                                    <div class="title-wrap">
                                                        <h4 class="cart-bottom-title section-bg-gary-cart">
                                                            مجموع سفارش </h4>
                                                    </div>
                                                    <h5 class="mt-5">
                                                       <div class="d-flex justify-content-between">
                                                        <span class="mx-2"> مبلغ سفارش : </span>
                                                        <span class="mx-4">
                                                            {{ number_format(\Cart::session(auth()->id())->getTotal() + cartTotalSaleAmount()) }}
                                                            تومان
                                                        </span>
                                                       </div>
                                                    </h5>

                                                    @if (cartTotalSaleAmount() > 0)
                                                        <hr>
                                                        <h5>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="mx-2"> مبلغ تخفیف کالا ها : </span>
                                                            <span class="mx-4" style="color: red">
                                                                {{ number_format(cartTotalSaleAmount()) }}
                                                                تومان
                                                            </span>
                                                        </div>
                                                        </h5>
                                                    @endif
                                                    @if (session()->has('coupon' . '-' . auth()->id()))
                                                        <h5>
                                                            <div class="d-flex justify-content-between">
                                                                <span class="mx-2"> مبلغ کد تخفیف : </span>
                                                            <span class="mx-4" style="color: red">
                                                                {{ number_format(session()->get('coupon' . '-' . auth()->id() . '.amount')) }}
                                                                تومان
                                                            </span>
                                                        </div>
                                                        </h5>

                                                    @endif
                                                    <hr>
                                                    <div class="total-shipping">
                                                        <h5>
                                                            <div class="d-flex justify-content-between">
                                                                <span class="mx-2"> هزینه ارسال : </span>
                                                                <span>
                                                            @if (cartTotalDeliveryAmount() == 0)
                                                                <span class="mx-4" style="color: red">
                                                                    ندارد
                                                                </span>
                                                            @else
                                                                <span class="mx-4">
                                                                    {{ number_format(cartTotalDeliveryAmount()) }}
                                                                    تومان
                                                                </span>
                                                            @endif
                                                        </div>
                                                        </h5>
                                                        <hr>
                                                    </div>
                                                    <h4 class="grand-totall-title ">
                                                        <div class="d-flex justify-content-between mb-5">
                                                            <span class="mx-2"> جمع کل : </span>
                                                        <span class="mx-4">
                                                            {{ number_format(cartTotalAmount()) }}
                                                            تومان
                                                        </span>
                                                    </div>
                                                    </h4>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('user.users_profile.orders.checkout') }}">
                                                        ادامه فرآیند خرید </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

