@extends('home.layouts.home')

@section('title')
    ثبت نام
@endsection
@section('style')
<style>

.footer {
    position: absolute !important;
}

</style>
@endsection
@section('content')
    <section class="py-0 col-md-12 py-lg-2 mt-5 mb-5 review">
        <br>
        <div class="container mt-3 mb-3 mb-5">
            <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                <div class="col mx-auto">
                    <h1 class="heading">ثبت نام</h1>
                    <div class="form-body">
                        <form action="{{ route('register') }}" class="row g-3" method="POST">
                            @csrf
                            <div class="col-sm-12">
                                <label for="inputName" class="form-label"> نام و نام خانوادگی
                                </label>
                                <input type="text" class="form-control" name="name" id="inputFirstName"
                                    placeholder="نام و نام خانوادگی ..." value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <div class="input-error-validation text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="col-sm-12">
                                <label for="inputEmailAddress" class="form-label"> آدرس ایمیل
                                </label>
                                <input type="email" class="form-control" name="email" id="inputEmailAddress"
                                    placeholder="example@user.com" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="input-error-validation text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="col-sm-12">
                                <label for="inputChoosePassword" class="form-label">رمز
                                    عبور</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" name="password" class="form-control" id="inputChoosePassword"
                                        placeholder="رمز عبور ...">
                                </div>
                            </div>
                            @error('password')
                                <div class="input-error-validation text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="col-sm-12 mb-3">
                                <label for="inputChoosePassword" class="form-label">تکرار رمز
                                    عبور</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control" id="inputChoosePassword"
                                        name="password_confirmation" placeholder="تکرار رمز عبور ...">
                                </div>
                            </div>
                            @error('password_confirmation')
                                <div class="input-error-validation text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="col-sm-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-info"><i class='fas fa-user'></i> ثبت نام
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                        <div class="d-grid ">
                            <a class="btn my-4 btn-danger" href="{{ route('provider.login', ['provider' => 'google']) }}">
                                <span class="d-flex justify-content-center align-items-center">
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
                                    <img class="me-2" src="{{ asset('/img/user-interface.png') }}" width="16"
                                        alt="Image Description">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 image text-center mt-5">
                    <img class="mt-5" src="/img/register.svg" alt="signup" style="width: 500px;">
                </div>
            </div>
        </div>
    </section>
@endsection
