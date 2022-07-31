@extends('admin.layouts.admin')

@section('title')
    ایجاد ویژگی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد ویژگی</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.attributes.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-4 mt-2">
                                    <label for="name">نام</label>
                                    <input class="form-control" id="name" name="name" type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                            <button class="btn btn-success mt-3 mx-3 mb-3" type="submit">ثبت</button>
                            <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary mt-3  mb-3">بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
@endsection
