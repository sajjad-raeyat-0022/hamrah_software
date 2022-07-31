<div class="box">
    <a href="#"><img src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image) }}"
            alt="{{ $course->primary_image }}"></a>
    <h3><a href="{{ route('home.courses.show', ['course' => $course->slug]) }}">{{ $course->name }}</a>
    </h3>
    <a href="{{ route('home.categories.show', ['category' => $course->category->slug]) }}">
        <p>{{ $course->category->name }}</p>
    </a>
    {{-- <a href="#">
        <p>{{ $course->description }}</p>
    </a> --}}
    <div class="d-flex justify-content-between">
        @php
            $sale_price_check = null;
            if ($course->sale_price != null && $course->date_on_sale_from < $now && $course->date_on_sale_to > $now) {
                $sale_price_check = true;
            } else {
                $sale_price_check = false;
            }
        @endphp
        <div class="price d-flex justify-content-between mx-3">
            @if ($sale_price_check)
            <span
                    class="me-1 text-muted text-decoration-line-through">{{ $course->price != null ? number_format($course->price) : رایگان }}
                    تومان</span>
                <b><span class="text-danger fs-5">{{ number_format($course->sale_price) }}
                        تومان</span></b>
            @else
                <b><span class="text-danger fs-5">{{ $course->price != null ? number_format($course->price) : رایگان }}
                        تومان</span></b>
            @endif
        </div>

        @auth
            @if ($course->checkUserFavoritelist(auth()->id()))
                <a class=" mx-3" href="{{ route('home.favoritelist.remove', ['course' => $course->id]) }}"><i class="fas fa-heart fa-lg" style="color: red"></i></a>
            @else
                <a class=" mx-3" href="{{ route('home.favoritelist.add', ['course' => $course->id]) }}"><i
                        class="far fa-heart fa-lg"></i></a>
            @endif
        @else
            <a class=" mx-3" href="{{ route('home.favoritelist.add', ['course' => $course->id]) }}"><i
                    class="far fa-heart fa-lg"></i></a>
        @endauth
    </div>
    <div class="d-flex justify-content-end mx-3 mt-4">
        <a href="{{ route('home.compare.add', ['course' => $course]) }}"><i class="fas fa-sync-alt fa-lg"></i></a>
    </div>
    <div class="stars d-flex justify-content-between mx-3">
        <div>
            <br>
            <i>امتیاز :</i>
        </div>
        <div class="mt-3">
            <div data-rating-stars="5" data-rating-readonly="true"
                data-rating-value="{{ ceil($course->rates->avg('rate')) }}">
            </div>
        </div>
    </div>
</div>
