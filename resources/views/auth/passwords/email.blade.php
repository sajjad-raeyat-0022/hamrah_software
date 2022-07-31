@extends('home.layouts.home')
@section('title')
    فراموشی رمز عبور
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
                    <h1 class="heading">فراموشی رمز عبور</h1>
                    <br>
                    <div class="col-md-12">
                        <div class="card-body mt-3">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end"> آدرس ایمیل </label>

                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary mt-3">
                                            ارسال لینک تغییر رمز عبور
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 image text-center mt-5">
                    <img class="mt-5" src="/img/Forgotpass.svg" alt="signup" style="width: 300px;">
                </div>
            </div>
        </div>
    </section>
@endsection
