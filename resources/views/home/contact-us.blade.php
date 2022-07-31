@extends('home.layouts.home')

@section('title')
    تماس با ما
@endsection

@section('content')
    <section class=" home" id="contact">
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading text-bold">تماس با ما</h1>
                    <h3 class="title text-white">ما عاشق مکالمه هستیم ، اجازه می دهیم صحبت کنیم.</h3>


                    <div class="row mx-3">
                        <div class="col-md-6 col-sm-12 form-container mt-3">
                            <form action="{{ route('home.contact-us.form') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" name="name" type="text" placeholder="نام و نام خانوادگی"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="input-error-validation">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" type="email" placeholder="ایمیل شما"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="input-error-validation">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="subject" type="text" placeholder="موضوع پیام"
                                        value="{{ old('subject') }}">
                                    @error('subject')
                                        <p class="input-error-validation">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="text" cols="30" rows="10"
                                        value="{{ old('message') }}" placeholder="پیام شما"></textarea>
                                    @error('text')
                                        <p class="input-error-validation">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <input class="btn btn-primary" type="submit" value="ارسال">
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12 image text-center">
                            <img src="/img/contact-img.svg" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="review">
        <div class="col-md-12 mb-5">
            <div class="contact-info-content d-flex justify-content-center">
                <i class="fas fa-map-marker-alt fa-2x text-danger mx-3"></i>
                <p class="mt-2"><a href="#">{{ $setting->address }}</a></p>
            </div>
            <div class="contact-info-content d-flex justify-content-center">
                <i class="far fa-envelope fa-2x text-danger mx-3"></i>
                <p class="mt-2"><a href="#">{{ $setting->gmail }}</a></p>
            </div>
            <div class="contact-info-content d-flex justify-content-center">
                <i class="fas fa-mobile-alt fa-2x text-danger mx-3"></i>
                <p class="mt-2"><a href="#">{{ $setting->telephone }}</a> / <a
                        href="#">{{ $setting->telephone2 }}</a></p>
            </div>
            <div class="contact-info-content d-flex justify-content-center">
                <i class="fab fa-whatsapp fa-2x text-danger mx-3"></i>
                <p class="mt-2"><a href="#">{{ $setting->whatsapp }}</a></p>
            </div>
        </div>
    </section>
@endsection
