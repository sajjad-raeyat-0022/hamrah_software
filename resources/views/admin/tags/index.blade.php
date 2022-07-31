@extends('admin.layouts.admin')

@section('title')
     تگ ها
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
                        <div class="d-flex justify-content-between mb-4 mx-3">
                            <h5 class="font-weight-bold">لیست تگ ها ({{ $tags->total() }})</h5>
                            <a class="btn btn-sm btn-success" href="{{ route('admin.tags.create') }}">
                                <i class="fa fa-plus"></i>
                                ایجاد تگ
                            </a>
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
                                    @foreach ($tags as $key => $tag)
                                        <tr>
                                            <th>
                                                {{ $tags->firstItem() + $key }}
                                            </th>
                                            <th>
                                                {{ $tag->name }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold"
                                                    href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}">نمایش</a>
                                                <a class="btn btn-sm btn-outline-warning mr-3 text-bold"
                                                    href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}">ویرایش</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                    {{ $tags->withQueryString()->onEachSide(2)->render() }}
                    {{-- {{ $tags->fragment('tags')->links() }} --}}
                    {{-- {{ $tags->links() }} --}}
                </div>
            </div>
        </section>
    </div>
@endsection
