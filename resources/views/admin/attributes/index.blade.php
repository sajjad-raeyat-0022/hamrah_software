@extends('admin.layouts.admin')

@section('title')
     ویژگی ها
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
                            <h5 class="font-weight-bold">لیست ویژگی ها ({{ $attributes->total() }})</h5>
                            @can('create-attribute')
                            <a class="btn btn-sm btn-success" href="{{ route('admin.attributes.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد ویژگی
                            </a>
                            @endcan
                        </div>
                        <div>
                            <table class="table table-secondary table-bordered table-striped text-center">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributes as $key => $attribute)
                                        <tr>
                                            <th>
                                                {{ $attributes->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $attribute->name }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold"
                                                    href="{{ route('admin.attributes.show', ['attribute' => $attribute->id]) }}">نمایش</a>
                                                @can('edit-attribute')
                                                <a class="btn btn-sm btn-outline-warning text-bold mr-3"
                                                    href="{{ route('admin.attributes.edit', ['attribute' => $attribute->id]) }}">ویرایش</a>
                                                @endcan
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $attributes->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $attributes->fragment('attributes')->links() }} --}}
                    {{-- {{ $attributes->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
