@extends('admin.layouts.admin')

@section('title')
     دیدگاه ها
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
                            <h5 class="font-weight-bold">لیست دیدگاه ها ({{ $comments->total() }})</h5>

                        </div>
                        <div>
                            <table class="table table-bordered table-striped text-center">

                                <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام کاربر</th>
                                        <th>نام محصول</th>
                                        <th>متن کامنت</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $key => $comment)
                                        <tr>
                                            <th>
                                                {{ $comments->firstItem() + $key }}
                                            </th>
                                            <th>
                                                    {{ $comment->user->name == null ? $comment->user->cellphone : $comment->user->name  }}
                                            </th>
                                            <th>
                                                <a href="{{ route('admin.courses.show' , ['course' => $comment->course->id]) }}">
                                                    {{ $comment->course->name }}
                                                </a>
                                            </th>
                                            <th>
                                                {{ $comment->text }}
                                            </th>
                                            <th
                                                class="{{ $comment->getRawOriginal('approved') ? 'text-success' : 'text-danger' }}">
                                                {{ $comment->approved }}
                                            </th>
                                            <th>
                                                <a class="btn btn-sm btn-outline-info text-bold mb-2" href="{{ route('admin.comments.show', ['comment' => $comment->id]) }}">نمایش</a>
                                                @can('remove-comment')
                                                <form action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-sm btn-outline-danger text-bold" type="submit">حذف</button>
                                                </form>
                                                @endcan
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $comments->render() }}
                </div>
            </div>
        </section>
    </div>
@endsection
