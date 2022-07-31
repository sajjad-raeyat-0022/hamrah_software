@extends('admin.layouts.admin')

@section('title')
    ویرایش کاربر
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش کاربر : {{ $user->name }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.users.update' , ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-4 mt-3">
                                    <label for="name">نام و نام خانوادگی</label>
                                    <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="name">شماره تلفن همراه</label>
                                    <input class="form-control"name="phone_number" type="text" value="{{ $user->phone_number }}">
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="name">آدرس ایمیل</label>
                                    <input class="form-control"name="email" type="text" value="{{ $user->email }}">
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="role">نقش کاربر</label>
                                    <select class="form-control" name="role" id="role">
                                        <option></option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="name">نوع کاربر</label>
                                    <input class="form-control"name="email" type="text" value="{{ $user->email }}">
                                </div> --}}
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
                                                            {{ in_array( $permission->id , $user->permissions->pluck('id')->toArray() ) ? 'checked' : '' }}
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
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-5 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
