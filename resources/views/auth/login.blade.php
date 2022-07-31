@extends('home.layouts.home')

@section('title')
    ورود
@endsection
@section('style')
<style>

.footer {
    position: absolute !important;
}

</style>
@endsection
@section('content')
    <section class="py-0 col-md-12 py-lg-2 mt-5 mb-2 review">
        <br>

        <div class="container mt-3 mb-3 mb-5">

            <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">

                <div class="col mx-auto">
                    <h1 class="heading">ورود</h1>
                    <div class="form-body ">
                        <form action="{{ route('login') }}" method="POST" class="row g-3 ">
                            @csrf
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label"> آدرس ایمیل </label>
                                <input type="email" class="form-control" name="email" id="inputEmailAddress"
                                    value="{{ old('email') }}" placeholder="آدرس ایمیل ...">
                            </div>
                            @error('email')
                                <div class="input-error-validation text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class <div class="col-12">
                                <label for="inputChoosePassword" class="form-label"> رمز عبور </label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control" id="inputChoosePassword" name="password"
                                        placeholder="رمز عبور ...">
                                </div>
                            </div>
                            @error('password')
                                <div class="input-error-validation text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class=" d-flex justify-content-between">
                                <div class="form-check form-switch">
                                    <input name="remember" class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked"> مرا به خاطر بسپار </label>
                                </div>
                                <div class=" text-end"> <a href="{{ route('password.request') }}">رمز خود را
                                        فراموش کرده ام</a>
                                </div>
                            </div>
                            <div class="d-grid mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-info mt-3 mx-4">
                                        ورود <i class="fas fa-envelope mx-2"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="d-grid ">
                                    <a class="btn my-4 btn-danger"
                                        href="{{ route('provider.login', ['provider' => 'google']) }}"> <span
                                            class="d-flex justify-content-center align-items-center">
                                            <span> ورود با حساب گوگل </span>
                                            <img class="me-2" src="{{ asset('/img/search.svg') }}" width="16"
                                                alt="Image Description">
                                        </span>
                                    </a>
                                </div>
                                <div class="d-grid">
                                    <a class="btn my-1 shadow-sm btn-warning" href="{{ route('login-mobile') }}"> <span
                                            class="d-flex justify-content-center align-items-center">
                                            <span> ثبت نام و ورود با استفاده از شماره تلفن </span>
                                            <img class="me-2" src="{{ asset('/img/user-interface.png') }}"
                                                width="16" alt="Image Description">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-6 col-sm-12 image text-center mt-5">
                    <img class="mt-5" src="/img/Login.svg" alt="signup" style="width: 400px;">
                </div>
            </div>
        </div>
    </section>
@endsection
