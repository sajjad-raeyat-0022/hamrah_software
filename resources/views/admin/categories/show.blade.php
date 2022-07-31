@extends('admin.layouts.admin')

@section('title')
     دسته بندی ها
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">دسته بندی : {{ $category->name }}</h5>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>نام</label>
                                <input class="form-control" type="text" value="{{ $category->name }}" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>نام انگلیسی</label>
                                <input class="form-control" type="text" value="{{ $category->slug }}" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>والد</label>
                                <div class="form-control div-disabled">
                                    @if ($category->parent_id == 0)
                                        {{ $category->name }}
                                    @else
                                        {{ $category->parent->name }}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>وضعیت</label>
                                <input class="form-control" type="text" value="{{ $category->is_active }}" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>آیکون</label>
                                <input class="form-control" type="text" value="{{ $category->icon }}" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label>تاریخ ایجاد</label>
                                <input class="form-control" type="text" value="{{ verta($category->created_at) }}" disabled>
                            </div>

                            <div class="form-group col-md-12">
                                <label>توضیحات</label>
                                <textarea class="form-control" disabled>{{ $category->description }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <hr>

                                <div class="row">

                                    <div class="col-md-12 mt-3">
                                        <label>ویژگی ها</label>
                                        <div class="form-control div-disabled">
                                            @foreach ($category->attributes as $attribute)
                                                {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label>ویژگی های اولیه قابل فیلتر شدن</label>
                                        <div class="form-control div-disabled">
                                            @foreach ($category->attributes()->wherePivot('is_filter' , 1)->get() as $attribute)
                                                {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-12">
                                        <label>ویژگی متغیر</label>
                                        <div class="form-control div-disabled">
                                            @foreach ($category->attributes()->wherePivot('is_variation' , 1)->get() as $attribute)
                                                {{ $attribute->name }}{{ $loop->last ? '' : '،' }}
                                            @endforeach
                                        </div>
                                    </div> --}}

                                </div>
                            </div>

                        </div>

                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-4 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
