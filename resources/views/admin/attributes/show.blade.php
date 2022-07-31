@extends('admin.layouts.admin')

@section('title')
     ویژگی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">ویژگی : {{ $attribute->name }}</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 mt-3 mx-3">
                                <label>نام</label>
                                <input class="form-control" type="text" value="{{ $attribute->name }}" disabled>
                            </div>
                            <div class="form-group col-md-3 mt-3">
                                <label>تاریخ ایجاد</label>
                                <input class="form-control" type="text" value="{{ verta($attribute->created_at) }}" disabled>
                            </div>

                        </div>

                        <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary mt-2 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
