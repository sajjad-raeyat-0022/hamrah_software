@extends('admin.layouts.admin')

@section('title')
    دسته بندی ها
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
                            <h5 class="font-weight-bold">لیست دسته بندی ها ({{ $categories->total() }})</h5>
                           @can('create-category')
                           <a class="btn btn-sm btn-success" href="{{ route('admin.categories.create') }}">
                            <i class="fa fa-plus"></i>
                            ایجاد دسته بندی
                        </a>
                           @endcan
                        </div>
                        <div>
                            <table class="table table-secondary table-bordered table-striped text-center">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>نام انگلیسی</th>
                                        <th>والد</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <th>
                                                {{ $categories->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $category->name }}
                                            </th>
                                            <th>
                                                {{ $category->slug }}
                                            </th>
                                            <th>
                                                @if ($category->parent_id == 0)
                                                    بدون والد
                                                @else
                                                    {{ $category->parent->name }}
                                                @endif
                                            </th>

                                            <th>
                                                <span
                                                    class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                                    {{ $category->is_active }}
                                                </span>
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold"
                                                    href="{{ route('admin.categories.show', ['category' => $category->id]) }}">نمایش</a>
                                                @can('edit-category')
                                                <a class="btn btn-sm btn-outline-warning mr-3 text-bold"
                                                    href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">ویرایش</a>
                                                @endcan
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    {{ $categories->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $categories->fragment('categories')->links() }} --}}
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
