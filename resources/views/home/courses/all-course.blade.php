@extends('home.layouts.home')

@section('title')
    خانه
@endsection

@section('content')

    <section class="review">
        <br><br>

        <h1 class="heading">
            @php
                if(!empty($_GET['popular']) && $_GET['popular'] == 'true'){
                    echo 'دوره های پرفروش';
                }
                else if(!empty($_GET['coupon']) && $_GET['coupon'] == 'true'){
                    echo 'دوره های تخفیف دار';
                }
                else if(!empty($_GET['search'])){
                    echo 'دوره های شامل کلمه: ' .'(' .$_GET['search'] .')';
                }
                else {
                    echo 'تمامی دوره ها';
                }
            @endphp
        </h1>
        <h3 class="title"> دوره‌های آموزش از راه دور </h3>

        <div class="box-container">
             @php
                $now = Carbon\Carbon::now();
                if (!empty($_GET['popular']) && $_GET['popular'] == 'true') {
                    $key=0;
                    $sum=0;
                    foreach ($courses as $key => $course){
                        $sum += $course->order_items_count;
                    }
                    $avg = $sum/($key+1);
                }
            @endphp
            @if (!empty($_GET['popular']) && $_GET['popular'] == 'true')
                @foreach ($courses as $course)
                    @if ($course->order_items_count > $avg)
                        @include('home.partials.course-information')
                    @endif
                @endforeach
            @else
                @foreach ($courses as $course)
                    @include('home.partials.course-information')
                @endforeach
            @endif
            <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                {{ $courses->withQueryString()->onEachSide(2)->render() }}
                {{-- {{ $courses->fragment('courses')->links() }} --}}
                {{-- {{ $courses->links() }} --}}
            </div>
        </div>

    </section>

@endsection
