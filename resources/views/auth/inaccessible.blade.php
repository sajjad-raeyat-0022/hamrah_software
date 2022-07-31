@extends('home.layouts.home')
@section('title')
    غیر قابل دسترس
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
                    <h1 class="heading">شما اجازه دسترسی به این صفحه را ندارید</h1>
                    <br>
                    <div class="col-md-12 text-center"><img src="/img/lock-12.png" alt="lock" style="height: 200px; width:200px;"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
