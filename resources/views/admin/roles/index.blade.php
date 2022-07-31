@extends('admin.layouts.admin')

@section('title')
     نقش ها
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
                            <h5 class="font-weight-bold">لیست نقش ها ({{ $roles->total() }})</h5>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.roles.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد نقش
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center table-secondary">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام نمایشی</th>
                                        <th>نام</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <th>
                                                {{ $roles->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $role->display_name }}
                                            </th>
                                            <th>
                                                {{ $role->name }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold"
                                                    href="{{ route('admin.roles.show', ['role' => $role->id]) }}">
                                                    نمایش
                                                </a>
                                                <a class="btn btn-sm btn-outline-warning mr-3 text-bold"
                                                    href="{{ route('admin.roles.edit', ['role' => $role->id]) }}">
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
                    {{ $roles->withQueryString()->onEachSide(2)->render() }}
                </div>
            </div>
        </section>
    </div>
@endsection
