@extends('admin.layouts.admin')

@section('title')
    ایجاد مجوز
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد مجوز</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.permissions.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-6 mt-2">
                                    <label for="name">نام نمایشی</label>
                                    <input class="form-control" name="display_name" type="text" {{ old('display_name') }}>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="name">نام انگلیسی</label>
                                    <input class="form-control" name="name" type="text" {{ old('name') }}>
                                </div>
                            </div>
                                <button class="btn btn-success mt-3 mb-5 mx-3" type="submit">ثبت</button>
                                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary mt-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
