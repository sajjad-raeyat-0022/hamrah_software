@extends('user.layouts.user')

@section('title')
    دیدگاه های کاربر
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-11 col-md-11 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="font-weight-bold">دیدگاه ها</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            @if ($comments->isEmpty())
                                <div class="alert alert-danger">
                                    شما برای هیچ دوره ای دیدگاهی ثبت نکرده اید
                                </div>
                            @else

                                @foreach ($comments as $comment)
                                    <div class="d-flex align-items-start">
                                        <div class="review-user">
                                            <img src="@php
                                        if($comment->user->avatar == null){
                                            echo '/img/2730042.png';
                                        }
                                        elseif($comment->user->provider == 'google'){
                                            echo $comment->user->avatar;
                                        }else{
                                            echo $comment->user->avatar;
                                        }
                                        @endphp"
                                                style="height: 65px; width:65px;" class="rounded-circle mx-3" alt="" />
                                        </div>
                                        <div class="review-top-wrap mx-3">
                                            <div class="review-name d-flex align-items-center">
                                                <h6>
                                                    برای محصول :
                                                </h6>
                                                <a class="mx-2 text-primary"
                                                    href="{{ route('home.courses.show', ['course' => $comment->course->slug]) }}">
                                                    <b> {{ $comment->course->name }} </b>
                                                </a>
                                            </div>
                                            <div class="mt-2">
                                                <p>{{ $comment->text }}</p>
                                            </div>
                                            <div>
                                                در تاریخ :
                                                {{ verta($comment->created_at)->format('%d %B، %Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $comm = App\Models\Comment::where('answer_to',$comment->user->id)->where('course_id',$comment->course->id)->first();
                                    // dd($comm);
                                    @endphp
                                    @if ($comm != null)
                                        <div class="d-flex align-items-start mx-5">
                                            <div class="review-user">
                                                <img src="{{ asset('/img/back-arrow.png') }}"
                                                    style="height: 25px; width:25px;"
                                                    class="mx-3 mt-4" alt="" />
                                            </div>
                                        <div class="review-user">
                                            <img src="@php
                                                if($comm->user->avatar == null){
                                                    echo '/img/2730042.png';
                                                }
                                                elseif($comm->user->provider == 'google'){
                                                echo $comm->user->avatar;
                                                }else{
                                                echo $comm->user->avatar;
                                                }
                                                @endphp"
                                                style="height: 65px; width:65px;"
                                                class="rounded-circle mx-3 mt-4" alt="" />
                                        </div>
                                        <div class="review-content ms-3">
                                            <h5><b>پاسخ: </b></h5>
                                            <div class="d-flex align-items-center mb-2">
                                                <h5 class="mb-0 text-danger text-bold">
                                                    {{ $comm->user->name == null ? 'کاربر شماره ' . $comm->user->id : $comm->user->name }}
                                                </h5>
                                            </div>
                                            <p>{{ $comm->text }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    <hr />
                                @endforeach

                            @endif
                        </div>
                    </div>

                </div>
        </section>
    </div>
@endsection
