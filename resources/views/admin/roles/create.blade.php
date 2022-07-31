@extends('admin.layouts.admin')

@section('title')
    ایجاد نقش
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد نقش</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام نمایشی</label>
                                    <input class="form-control" name="display_name" type="text" {{ old('display_name') }}>
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام انگلیسی</label>
                                    <input class="form-control" name="name" type="text" {{ old('name') }}>
                                </div>

                                <div class="accordion col-md-12 mt-2" id="accordionPermission">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            {{-- <h2 class="mb-0"> --}}
                                                <button class="btn btn-link btn-block text-primary text-right text-bold" type="button" data-toggle="collapse"
                                                    data-target="#collapsePermission" aria-expanded="true" aria-controls="collapseOne">
                                                    مجوز های دسترسی
                                                </button>
                                            {{-- </h2> --}}
                                        </div>

                                        <div id="collapsePermission" class="collapse col-md-12" aria-labelledby="headingOne"
                                            data-parent="#accordionPermission">
                                            <div class="card-body row">
                                                @foreach ($permissions as $permission)
                                                    <div class="form-group form-check col-md-2 mx-5">
                                                        <input type="checkbox" class="form-check-input" id="permission_{{$permission->id}}"
                                                        name="{{$permission->name}}" value="{{$permission->name}}">
                                                        <label class="form-check-label mr-3" for="permission_{{$permission->id}}">{{ $permission->display_name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-success mt-5 mb-5 mx-3" type="submit">ثبت</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
