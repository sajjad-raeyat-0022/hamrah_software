@extends('admin.layouts.admin')

@section('title')
     مجوز ها
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
                            <h5 class="font-weight-bold">لیست مجوز ها ({{ $permissions->total() }})</h5>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.permissions.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد مجوز
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
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <th>
                                                {{ $permissions->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $permission->display_name }}
                                            </th>
                                            <th>
                                                {{ $permission->name }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-warning mr-3 text-bold"
                                                    href="{{ route('admin.permissions.edit', ['permission' => $permission->id]) }}">ویرایش</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $permissions->withQueryString()->onEachSide(2)->render() }}
                </div>
            </div>
        </section>
    </div>
@endsection
