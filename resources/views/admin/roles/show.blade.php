@extends('admin.layouts.admin')

@section('title')
    نقش
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">نقش : {{ $role->display_name }}</h5>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام نمایشی</label>
                                    <input class="form-control" disabled name="display_name" type="text"
                                        value="{{ $role->display_name }}">
                                </div>
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام</label>
                                    <input class="form-control" name="name" disabled type="text"
                                        value="{{ $role->name }}">
                                </div>

                                <div class="accordion col-md-12 mt-2" >
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                                <div class="text-primary text-bold text-right">
                                                    مجوز های دسترسی
                                                </div>
                                        </div>

                                        <div id="collapsePermission" class="collapse show col-md-12">
                                            <div class="card-body row">
                                                @foreach ($role->permissions as $permission)
                                                    <div class="col-md-2 mx-5">
                                                        <span>{{ $permission->display_name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-5 mb-5 mx-3">بازگشت</a>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
