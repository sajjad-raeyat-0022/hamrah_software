@extends('admin.layouts.admin')

@section('title')
     دیدگاه
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info bg-light">

                        <div class="box-header with-border">
                            <h5 class="font-weight-bold">دیدگاه</h5>
                        </div>
                        @include('partials.errors')
                        <div class="row">

                                <div class="form-group col-md-6 mt-3">
                                    <label>نام کاربر</label>
                                    <input class="form-control" type="text" value="{{ $comment->user->name == null ? $comment->user->cellphone : $comment->user->name  }}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>نام محصول</label>
                                    <input class="form-control" type="text" value="{{ $comment->course->name }}" disabled>
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label>وضعیت</label>
                                    <input class="form-control" type="text" value="{{ $comment->approved }}" disabled>
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label>تاریخ ایجاد</label>
                                    <input class="form-control" type="text" value="{{ verta($comment->created_at) }}" disabled>
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label>متن</label>
                                    <textarea class="form-control" disabled>{{ $comment->text }}</textarea>
                                </div>
                                <div class="accordion col-md-12 mt-3 mb-3" id="answer">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                                <button class="btn btn-link btn-block text-bold text-primary text-right" type="button" data-toggle="collapse"
                                                    data-target="#collapseAnswer" aria-expanded="true" aria-controls="collapseOne">
                                                    پاسخ به دیدگاه
                                                </button>
                                        </div>

                                        <div id="collapseAnswer" class="collapse col-md-12" aria-labelledby="headingOne"
                                            data-parent="#answer">
                                            <div class="card-body row">
                                                @php
                                                    $comm = App\Models\Comment::where('answer_to',$comment->user->id)->where('course_id',$comment->course->id)->where('user_id',Auth::user()->id)->first();
                                                    // dd($comm);
                                                @endphp
                                                @if ($comm == null)
                                                    <form action="{{ route('admin.comments.store', ['course' => $comment->course->id , 'answer_to' =>$comment->user->id ]) }}" method="POST">
                                                        @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label">متن پاسخ</label>
                                                                <textarea class="form-control rounded-0" name="text" rows="3"></textarea>
                                                            </div>
                                                            <button type="submit" type="button" class="btn btn-success btn-ecomm">ارسال پاسخ</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.comments.update', ['comment'=>$comm->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label">متن پاسخ</label>
                                                                <textarea class="form-control rounded-0" name="text" rows="3">{{ $comm != null ? $comm->text : '' }}</textarea>
                                                            </div>
                                                            <button type="submit" type="button" class="btn btn-warning btn-ecomm">ویرایش پاسخ</button>
                                                    </form>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @if ($comment->getRawOriginal('approved'))
                        <a href="{{ route('admin.comments.change-approve' , ['comment' => $comment->id]) }}" class="btn btn-danger mt-3 mb-5">عدم تایید</a>
                    @else
                        <a href="{{ route('admin.comments.change-approve' , ['comment' => $comment->id]) }}" class="btn btn-success mt-3 mb-5">تایید</a>
                    @endif

                        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary mt-2 mb-5 mx-3">بازگشت</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
