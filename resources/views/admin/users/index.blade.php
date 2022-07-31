@extends('admin.layouts.admin')

@section('title')
     کاربران
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="font-weight-bold">لیست کاربران ({{ $users->total() }})</h5>
                            {{-- <a class="btn btn-sm btn-success" href="{{ route('admin.users.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد کاربر جدید
                            </a> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center table-secondary">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>ایمیل</th>
                                        <th>شماره تلفن</th>
                                        <th>نوع ثبت نام کاربر</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th>
                                                {{ $users->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $user->name }}
                                            </th>
                                            <th>
                                                {{ $user->email }}
                                            </th>
                                            <th>
                                                {{ $user->phone_number }}
                                            </th>
                                            <th>
                                                {{ $user->provider }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-warning mr-3 mt-2 text-bold"
                                                    href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                                                    ویرایش
                                                </a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $users->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $attributes->fragment('attributes')->links() }} --}}
                    {{-- {{ $attributes->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
