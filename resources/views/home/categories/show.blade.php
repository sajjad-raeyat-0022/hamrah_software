@extends('home.layouts.home')

@section('title')
    محصولات |
@endsection

@section('content')


    <section class=" review">

            <div class="row">
                <div class="col-md-3 mt-5">
                    <br><br>
                    @include('home.categories.section.sidebar')
                </div>
                <div class="col-md-9">
                    <br><br>

                    <h2 class="heading">{{ $category->name }}</h2>

                    <div class="box-container">
                        @php
                            $now = Carbon\Carbon::now();
                        @endphp
                        @foreach ($courses as $course)
                            @include('home.partials.course-information')
                        @endforeach
                        <div id="pagination" class="container text-center d-flex justify-content-center mb-2">
                            {{ $courses->withQueryString()->onEachSide(2)->render() }}
                            {{-- {{ $courses->fragment('courses')->links() }} --}}
                            {{-- {{ $courses->links() }} --}}
                        </div>
                    </div>


                </div>

        </div>



    </section>

@endsection
@section('javascript-code')
    <script>
        function filter() {

            let attributes = @json($attributes);
            attributes.map(attribute => {

                let valueAttribute = $(`.attribute-${attribute.id}:checked`).map(function() {
                    return this.value;
                }).get().join('-');

                if (valueAttribute == "") {
                    $(`#filter-attribute-${attribute.id}`).prop('disabled', true);
                } else {
                    $(`#filter-attribute-${attribute.id}`).val(valueAttribute);
                }

            });

            let variation = $('.variation:checked').map(function() {
                return this.value;
            }).get().join('-');
            if (variation == "") {
                $('#filter-variation').prop('disabled', true);
            } else {
                $('#filter-variation').val(variation);
            }

            let sortBy = $('#sort-by').val();
            if (sortBy == "default") {
                $('#filter-sort-by').prop('disabled', true);
            } else {
                $('#filter-sort-by').val(sortBy);
            }

            let search = $('#search-input').val();
            if (search == "") {
                $('#filter-search').prop('disabled', true);
            } else {
                $('#filter-search').val(search);
            }
            $('#filter-form').submit();

        }

        $('#filter-form').on('submit', function(event) {
            event.preventDefault();
            let currentUrl = '{{ url()->current() }}';
            let url = currentUrl + '?' + decodeURIComponent($(this).serialize())
            $(location).attr('href', url);
        });
    </script>
    <script>
        function closeFilterSidebar() {
            document.getElementById("sidebarFilter").classList.remove('show');
            document.getElementById("sidebarFilter").classList.add('d-none');
        }

        function openFilterSidebar() {
            document.getElementById("sidebarFilter").classList.remove('d-none');
            document.getElementById("sidebarFilter").classList.add('show');
        }
    </script>
@endsection
