@extends('home.layouts.home')

@section('title')
    ورود با شماره تلفن
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
        <br><br>
        <div class="container mt-3 mb-3 mb-5">
            <div class="row">
                <div class="col mx-auto">
                    <br>
                    <h1 class="heading">ورود با شماره تلفن</h1>

                    <div class="form-body">
                        <form id="loginForm" class="row g-3">
                            <div class="col-12">
                                <label for="inputPhoneNumber" class="form-label"> شماره تلفن </label>
                                <input id="cellphoneInput" type="text" class="form-control" placeholder="شماره تلفن همراه ...">
                            </div>
                            <div id="cellphoneInputError" class="input-error-validation">
                                <strong id="cellphoneInputErrorText" class="text-danger"></strong>
                            </div>
                            <div class="col-md-4">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-info"> ارسال پیامک <i class="fas fa-sms"></i></button>
                                </div>
                            </div>
                        </form>
                        <form id="checkOTPForm" class="row g-3">
                            <div class="col-12">
                                <label for="checkOTPInput" class="form-label"> رمز یکبار مصرف </label>
                                <input id="checkOTPInput" type="text" class="form-control" placeholder="رمز یکبار مصرف ...">
                            </div>
                            <div id="checkOTPInputError" class="input-error-validation">
                                <strong id="checkOTPInputErrorText" class="text-danger"></strong>
                            </div>
                            <div class="col-12">
                                <div class="d-grid d-flex justify-content-between">
                                    <button type="submit" class="btn btn-info"> ورود <i class="bx bxs-lock-open"></i></button>
                                    <div>
                                        <button id="resendOTPButton" type="submit" class="btn btn-info"> ارسال مجدد پیامک </button>
                                        <span id="resendOTPTimer"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <br>
                <div class="col-md-6 col-sm-12 image text-center mt-5">
                    <img class="mt-5" src="/img/user-interface.png" alt="signup" style="width: 300px;">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript-code')
    {{-- OTP --}}
    <script>
        let loginToken;
        $('#checkOTPForm').hide();
        $('#resendOTPButton').hide();

        $('#loginForm').submit(function(event){
            console.log( $('#cellphoneInput').val() );
            event.preventDefault();

            $.post("{{ url('/login-mobile') }}",
            {
                '_token' : "{{ csrf_token() }}",
                'phone_number' : $('#cellphoneInput').val()

            } , function(response , status){
                console.log(response , status);
                loginToken = response.login_token;

                swal({
                    icon : 'success',
                    text : 'رمز یکبار مصرف برای شما ارسال شد',
                    button : 'باشه',
                    timer : 10000
                });

                $('#loginForm').fadeOut();
                $('#checkOTPForm').fadeIn();
                timer()

            }).fail(function(response){
                console.log(response.responseJSON);
                console.log(response);
                $('#cellphoneInput').addClass('mt-1');
                $('#cellphoneInputError').fadeIn();
                $('#cellphoneInputErrorText').html(response.responseJSON.errors.phone_number[0]);
            })
        });

        $('#checkOTPForm').submit(function(event){
            event.preventDefault();

            $.post("{{ url('/check-otp') }}",
            {
                '_token' : "{{ csrf_token() }}",
                'otp' : $('#checkOTPInput').val(),
                'login_token' : loginToken

            } , function(response , status){
                console.log(response , status);
                $(location).attr('href' , "{{ route('index') }}");

            }).fail(function(response){
                console.log(response.responseJSON);
                $('#checkOTPInput').addClass('mt-1');
                $('#checkOTPInputError').fadeIn();
                $('#checkOTPInputErrorText').html(response.responseJSON.errors.otp[0]);
            })
        });

        $('#resendOTPButton').click(function(event){
            event.preventDefault();

            $.post("{{ url('/resend-otp') }}",
            {
                '_token' : "{{ csrf_token() }}",
                'login_token' : loginToken

            } , function(response , status){
                console.log(response , status);
                loginToken = response.login_token;

                swal({
                    icon : 'success',
                    text : 'رمز یکبار مصرف برای شما ارسال شد',
                    button : 'باشه',
                    timer : 10000
                });

                $('#resendOTPButton').fadeOut();
                $('#resendOTPTimer').fadeIn();
                timer()

            }).fail(function(response){
                console.log(response.responseJSON);
                swal({
                    icon : 'errors',
                    text : 'مشکل در ارسال دوباره رمز یکبار مصرف، مجددا تلاش کنید',
                    button : 'باشه',
                    timer : 10000
                });
            })
        });

        function timer() {
            let time = "2:01";
            let interval = setInterval(function() {
                let countdown = time.split(':');
                let minutes = parseInt(countdown[0], 10);
                let seconds = parseInt(countdown[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) {
                    clearInterval(interval);
                    $('#resendOTPTimer').hide();
                    $('#resendOTPButton').fadeIn();
                };
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('#resendOTPTimer').html(minutes + ':' + seconds);
                time = minutes + ':' + seconds;
            }, 1000);
        }
    </script>
@endsection
