@extends('home.layouts.home')
@section('title')
    ایجاد رمز عبور جدید
@endsection
@section('style')
<style>

.footer {
    position: absolute !important;
}

</style>
@endsection
@section('content')
    <section class="py-0 col-md-12 py-lg-2 mt-2 mb-2 review ">
        <br><br><br>
        <div class="container mt-3 mb-3 mb-5">
            <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                <div class="col mx-auto">
                    <h1 class="heading">تایید آدرس ایمیل</h1>
                    <br>
                    <div class="col-md-12 mt-3">
                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    یک لینک تأیید جدید به آدرس ایمیل شما ارسال شد.
                                </div>
                            @endif
                            قبل از ادامه، لطفاً ایمیل خود را برای ورود بررسی و تأیید کنید.
                            <br>
                            ایمیل را دریافت نکرده اید؟!
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">درخواست ارسال دوباره
                                    ایمیل</button>.
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 text-center"><img src="/img/email-verified.png" alt="email"
                            style="height: 200px; width:200px;"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
