@extends('user.layouts.user')

@section('title')
    سفارش
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">سفارش</h4>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            @if (!session()->has('coupon' . '-' . auth()->id()))
                                <div class="customer-zone mb-20 col-md-12 mt-3">
                                    <p class="cart-page-title">
                                        کد تخفیف دارید؟
                                        <a class="checkout-click3" href="#" onclick="show_coupon()"> میتوانید با کلیک در این
                                            قسمت کد خود را
                                            اعمال کنید </a>
                                    </p>
                                    <div id="coupon" class="checkout-login-info3 col-md-6" style="display: none">
                                        <form action="{{ route('user.users_profile.cart.checkcoupon') }}" method="POST">
                                            @csrf
                                            <div class="form-group"><input class="form-control" type="text"
                                                    name="code" placeholder="کد تخفیف"></div>
                                            <div class="form-group"><input class="form-control btn btn-success"
                                                    type="submit" value="اعمال کد تخفیف"></div>

                                        </form>
                                    </div>
                                </div>
                            @endif
                                <div class="col-lg-7">
                                    <div class="billing-info-wrap mr-50">
                                        <h3> آدرس تحویل سفارش </h3>

                                        <div class="row">
                                            <p>
                                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                                از طراحان
                                                گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                                لازم است
                                            </p>
                                            <div class="col-lg-6 col-md-6 mt-2">
                                                <div class="form-group billing-info tax-select mb-20">
                                                    <label> انتخاب آدرس تحویل سفارش <abbr class="required text-danger"
                                                            title="required">*</abbr></label>

                                                    <select id="address-select" class="form-control email s-email s-wid"
                                                        name="address_id">
                                                        @foreach ($addresses as $key => $address)
                                                            <option value="{{ $address->id }}">
                                                                {{ $address->title }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 pt-30 mt-5">
                                                <button class="collapse-address-create btn btn-info"
                                                    onclick="toggle_visibility()"> ایجاد آدرس جدید </button>
                                            </div>

                                            <div class="col-lg-12">
                                                <div id="add-address" class="collapse-address-create-content mt-3"
                                                    style="{{ count($errors->addressStore) > 0 ? 'display:block' : 'display:none' }}">

                                                    <form action="{{ route('user.users_profile.addresse.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="form-group tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    عنوان
                                                                </label>
                                                                <input class="form-control" type="text" name="title"
                                                                    value="{{ old('title') }}">
                                                                @error('title', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شماره تماس
                                                                </label>
                                                                <input class="form-control" type="text"
                                                                    name="phone_number" value="{{ old('phone_number') }}">
                                                                @error('phone_number', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    استان
                                                                </label>
                                                                <select
                                                                    class="form-control email s-email s-wid state-select"
                                                                    name="state_id">
                                                                    @foreach ($states as $state)
                                                                        <option value="{{ $state->id }}">
                                                                            {{ $state->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('state_id', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شهر
                                                                </label>
                                                                <select class="form-control email s-email s-wid city-select"
                                                                    name="city_id">
                                                                </select>
                                                                @error('city_id', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    آدرس
                                                                </label>
                                                                <input class="form-control" type="text" name="address"
                                                                    value="{{ old('address') }}">
                                                                @error('address', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    کد پستی
                                                                </label>
                                                                <input class="form-control" type="text" name="postal_code"
                                                                    value="{{ old('postal_code') }}">
                                                                @error('postal_code', 'addressStore')
                                                                    <p class="input-error-validation">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </p>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group col-lg-12 col-md-12">

                                                                <button class="btn btn-success" type="submit"> ثبت آدرس
                                                                </button>
                                                            </div>



                                                        </div>

                                                    </form>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <form action="{{ route('home.payment') }}" method="POST">
                                        @csrf

                                        <div class="your-order-area">
                                            <h3> سفارش شما </h3>
                                            <hr>
                                            <div class="your-order-wrap gray-bg-4">
                                                <div class="your-order-info-wrap">
                                                    <div class="your-order-info">

                                                        <div class="d-flex justify-content-between">
                                                            <span class="mx-5 text-bold">محصول</span>
                                                            <span class="mx-5 text-bold">جمع</span>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <div class="your-order-middle">
                                                        @foreach (\Cart::session(auth()->id())->getContent() as $item)
                                                            <div class="d-flex justify-content-between">
                                                                <div class="mx-5">
                                                                    {{ $item->name }}
                                                                </div>
                                                                <span class="mx-4">
                                                                    {{ number_format($item->price) }}
                                                                    تومان
                                                                    @if ($item->associatedModel->is_sale)
                                                                        <br>
                                                                        <b style="font-size: 12px ; color:red">
                                                                            {{ $item->associatedModel->persent_sale }}%
                                                                            تخفیف
                                                                        </b>
                                                                    @endif
                                                                </span>
                                                            </div>

                                                        @endforeach
                                                        <hr>
                                                    </div>
                                                    <div class="your-order-info order-subtotal">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="mx-5">مبلغ: </span>
                                                            <span class="mx-4">
                                                                {{ number_format(\Cart::session(auth()->id())->getTotal() + cartTotalSaleAmount()) }}
                                                                تومان
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @if (cartTotalSaleAmount() > 0)
                                                        <div class="your-order-info order-subtotal">
                                                            <div class="d-flex justify-content-between">
                                                                <span class="mx-5">مبلغ تخفیف کالا ها: </span>
                                                                <span class="mx-4" style="color: red">
                                                                    {{ number_format(cartTotalSaleAmount()) }}
                                                                    تومان
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (session()->has('coupon' . '-' . auth()->id()))
                                                        <div class="your-order-info order-subtotal">
                                                            <div class="d-flex justify-content-between">
                                                                <span class="mx-5">مبلغ تخفیف کد تخفیف: </span>
                                                                <span class="mx-4" style="color: red">
                                                                    {{ number_format(session()->get('coupon' . '-' . auth()->id() . '.amount')) }}
                                                                    تومان
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="your-order-info order-shipping">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="mx-5">هزینه ارسال: </span>
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
                                                    </div>
                                                    <div class="your-order-info order-total">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="mx-5">جمع کل: </span>
                                                            <span class="mx-4 text-bold">
                                                                {{ number_format(cartTotalAmount()) }}
                                                                تومان </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="payment-method">
                                                    <div class="pay-top sin-payment mt-4 mb-3">
                                                        
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex justify-content-end">
                                                            <input id="zarinpal" class="input-radio" type="radio" value="zarinpal" checked="checked" name="payment_method">
                                                            <label for="zarinpal" class="mt-3 mx-3">درگاه پرداخت زرین پال</label>
                                                            </div>
                                                            <img src="/img/zarinpal.png"
                                                                class="img-fluid" style="height: 50px; width:50px"
                                                                alt="zarinpal">
                                                        </div>
                                                    </div>
                                                    <div class="pay-top sin-payment mt-4">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex justify-content-end">
                                                            <input id="pay" class="input-radio" type="radio" value="pay"
                                                            name="payment_method">
                                                            <label for="pay" class="mt-3 mx-3">درگاه پرداخت پی</label>
                                                            </div>
                                                            <img src="/img/pay.ir.png"
                                                                class="img-fluid" style="height: 40px; width:80px"
                                                                alt="pay.ir">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="Place-order mt-40">
                                                <button class="btn btn-success mt-3" type="submit">ثبت سفارش</button>
                                            </div>
                                            <input id="address-input" type="hidden" name="address_id">
                                        </div>

                                    </form>
                                </div>

                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
@section('javascript-code')
    <script>
        $('#address-input').val($('#address-select').val());
        $('#address-select').change(function() {
            // console.log($(this).val());
            $('#address-input').val($(this).val());
        });
        $('.state-select').change(function() {

            var stateID = $(this).val();

            if (stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/user-profile/get-state-cities-list') }}?state_id=" + stateID,
                    success: function(res) {
                        if (res) {
                            $(".city-select").empty();

                            $.each(res, function(key, city) {
                                console.log(city);
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });

                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });

        function toggle_visibility() {
            var x = document.getElementById("add-address");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function show_coupon() {
            var x = document.getElementById("coupon");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection
