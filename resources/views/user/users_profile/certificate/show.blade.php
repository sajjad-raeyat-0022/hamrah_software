@extends('user.layouts.user')

@section('title')
    مدرک دوره
@endsection

@section('content')
    <div class="content-wrapper"  >
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <div class="box box-info bg-light">
                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">امتحان دوره : {{ $score->course->name }}</h5>
                        </div>
                    @if ($score->user->name == null)
                        <div class="alert alert-danger">
                            برای دریافت مدرک دوره لطفا در پنل کاربری خود از قسمت پروفایل اطلاعات خود را تکمیل کنید.
                        </div>
                    @else

                        <div  id="myElement">
                            <div class="col-md-12 mt-5" style="margin-top: 50px;text-align:center;">
                                <img src="{{ asset('/img/MainLogo2.png') }}" alt="logo" style="width: 300px; margin-left">
                            </div>
                            <div style="text-align:center;">
                                <div class="col-md-8">

                                    <div class="d-flex justify-content-end mx-5">
                                        <h6 class="mx-5" style="color: rgb(173, 167, 167)">پیامبر اکرم صلی الله علیه و آله و سلم</h6>
                                        </div>
                                    <div class="d-flex justify-content-end mx-4">
                                        <h5 class="mx-4" style="color: rgb(73, 76, 224)">هر چیزی راهی دارد و راه بهشت دانش است</h5>
                                    </div>
                                    <div class="d-flex justify-content-end mx-5">
                                        <div class="mx-5">
                                        <h3 class="text-bold mx-5" style="font-size: 1.5rem; direction:rtl;">گواهینامه پایان دوره</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="mx-5 mt-5 mb-5" style=" direction:rtl;">
                                    گواهی می شود  سرکار خانم /جناب آقای <b>{{ $score->user->name }}</b> در آزمون <b>{{ $score->course->name }}</b> در تاریخ <b>{{ verta($score->updated_at) }}</b> شرکت نموده و با کسب نمره <b>{{ $score->total_grade }}</b>  از <b>{{ $score->exam->final_grade }}</b> این دوره را با موفقیت به پایان رسانده است.
                                </p>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <p class="mx-3 mt-4" >
                                    مدیریت سایت دوره های آموزشی همراه سافتور
                                </p>
                            </div>
                            <div class="col-md-11 d-flex justify-content-end text-center">
                                <p class="mx-5" style="margin-left:80px;">
                                    سجاد رعیت
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a href="{{ route('user.certificate.index') }}"
                        class="btn btn-secondary mt-5 mb-5 mx-3">بازگشت</a>
                        <a onclick="prt()"
                        class="btn btn-primary mt-5 mb-5">دانلود فایل pdf</a>
                    </div>
                    @endif
                </div>

            </div>
        </section>
    </div>
@endsection
@section('javascript-code')
    <script>
        function prt(){
            printJS('myElement', 'html')
        }
    </script>
@endsection
