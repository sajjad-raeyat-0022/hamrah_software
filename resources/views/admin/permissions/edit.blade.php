@extends('admin.layouts.admin')

@section('title')
    ویرایش مجوز
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش مجوز : {{ $permission->display_name }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.permissions.update' , ['permission' => $permission->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-6 mt-2">
                                    <label for="name">نام نمایشی</label>
                                    <input class="form-control" name="display_name" type="text" value="{{ $permission->display_name }}">
                                </div>

                                <div class="form-group col-md-6 mt-2">
                                    <label for="name">نام</label>
                                    <input class="form-control" name="name" type="text" value="{{ $permission->name }}">
                                </div>
                            </div>

                            <button class="btn btn-warning mt-3 mx-3 mb-5" type="submit">ویرایش</button>
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary mt-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
