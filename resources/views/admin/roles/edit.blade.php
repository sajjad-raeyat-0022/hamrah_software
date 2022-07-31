@extends('admin.layouts.admin')

@section('title')
    ویرایش نقش
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش نقش : {{ $role->display_name }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.roles.update', ['role' => $role->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام نمایشی</label>
                                    <input class="form-control" name="display_name" type="text" value="{{ $role->display_name }}">
                                </div>

                                <div class="form-group col-md-3 mt-2">
                                    <label for="name">نام</label>
                                    <input class="form-control" name="name" type="text" value="{{ $role->name }}">
                                </div>

                                <div class="accordion col-md-12 mt-3" id="accordionPermission">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                                <button class="btn btn-link btn-block text-bold text-primary text-right" type="button" data-toggle="collapse"
                                                    data-target="#collapsePermission" aria-expanded="true" aria-controls="collapseOne">
                                                    مجوز های دسترسی
                                                </button>
                                        </div>

                                        <div id="collapsePermission" class="collapse col-md-12" aria-labelledby="headingOne"
                                            data-parent="#accordionPermission">
                                            <div class="card-body row">
                                                @foreach ($permissions as $permission)
                                                    <div class="form-group form-check col-md-2 mx-5">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="permission_{{ $permission->id }}" name="{{ $permission->name }}"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array( $permission->id , $role->permissions->pluck('id')->toArray() ) ? 'checked' : '' }}
                                                            >
                                                        <label class="form-check-label mr-3"
                                                            for="permission_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-warning mt-5 mb-5 mx-3" type="submit">ویرایش</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
