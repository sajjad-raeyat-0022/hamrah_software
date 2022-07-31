@extends('admin.layouts.admin')

@section('title')
    بنر ها
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
                            <h5 class="font-weight-bold">لیست بنر ها ({{ $banners->total() }})</h5>
                           @can('create-banner')
                           <a class="btn btn-sm btn-success" href="{{ route('admin.banners.create') }}">
                            <i class="fa fa-plus"></i>
                            ایجاد بنر
                        </a>
                           @endcan
                        </div>
                        <div>
                            <table class="table table-bordered table-striped text-center table-secondary">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>عنوان</th>
                                        <th>الویت</th>
                                        <th>وضعیت</th>
                                        <th>نوع</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $key => $banner)
                                        <tr>
                                            <th>
                                                {{ $banners->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $banner->title }}
                                            </th>
                                            <th>
                                                {{ $banner->priority }}
                                            </th>
                                            <th>
                                                <span
                                                    class="{{ $banner->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                                    {{ $banner->is_active }}
                                                </span>
                                            </th>
                                            <th>
                                                {{ $banner->type }}
                                            </th>
                                            <th>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        عملیات
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-right" href="{{ route('admin.banners.show', ['banner' => $banner->id]) }}">مشاهده</a>
                                                        <a class="dropdown-item text-right" href="{{ route('admin.banners.edit', ['banner' => $banner->id]) }}">ویرایش</a>
                                                        @can('remove-banner')
                                                        <form
                                                            action="{{ route('admin.banners.destroy', ['banner' => $banner->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item text-right" type="submit">حذف</button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    {{ $banners->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $banners->fragment('banners')->links() }} --}}
                    {{-- {{ $banners->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
