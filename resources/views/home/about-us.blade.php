@extends('home.layouts.home')

@section('title')
    درباره ما
@endsection

@section('content')
{{-- <section class="home" >
    <br><br><br>

</section> --}}
<section class="about content bg-white home mb-5" id="about">
    <br><br><br>
    <h1 class="heading text-bold">درباره ما</h1>
    <h3 class="title text-white">سفر خود را با ما آغاز کنید</h3>

    <div class="row">
        <div class="col-md-10 justify-content-between">
            <div class="col-md-6 image">
                <img src="/img/about-img.svg" alt="">
            </div>
            <div class="col-md-6 box-container mt-3">
                <br><br>
                <p style="color: white">داستان از آنجا شروع شد که من سجاد رعیت پس از گذراندن دوره کارشناسی در رشته نرم افزار قصد ورود به بازار کار در همین زمینه داشتم اما مسیر یادگیری و کسب درآمد برایم روشن نبود. از کجا شروع کنم؟ چه زبانی یادبگیرم؟ یادگیری کدوم رو اول شروع کنم؟ چطور ادامه بدم؟ تحقیق و پرس و جو بشتر باعث سردگمی بیشتر من میشد. </p>
                <p style="color: white">نبود مسیر مشخص برای برنامه نویسی وب از میان تکنولوژی های مختلف اولین مشکلی هست که من و سایر برنامه نویسان علاقه مندان به دنیای وب با آن روبرو می شوند. و اما مشکلی برنامه نویسان وب همواره در ادامه راه با آن دست و پنجه نرم می کنند نبود آموزش های پروژه محور به زبان فارسی هست. به همین منظور تصمیم گرفتم تحربه هایم را در اختیار علاقه مندان به حوزه وب قرار بدم.</p>
                {{-- <a href="#" class="text-center"><button class="btn btn-danger">بیشتر بدانید</button></a> --}}
            </div>
        </div>
    </div>
</section>
@endsection
