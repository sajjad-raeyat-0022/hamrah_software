@extends('admin.layouts.admin')

@section('title')
    ویرایش تگ
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-warning bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش تگ : {{ $tag->name }}</h3>
                        </div>
                        @include('partials.errors')

                        <form action="{{ route('admin.tags.update', ['tag' => $tag->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-4 mt-3">
                                    <label for="name">نام</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                        value="{{ $tag->name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                            <button class="btn btn-warning mt-3 mx-3 mb-3" type="submit">ویرایش</button>
                            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary mt-3 mb-3">بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
@endsection
