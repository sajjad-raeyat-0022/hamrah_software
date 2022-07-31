@extends('admin.layouts.admin')

@section('title')
    ویرایش دسته بندی دوره آموزشی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش دسته بندی دوره آموزشی : {{ $course->name }}</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.courses.category.update', ['course' => $course->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-3">
                                            <label for="category_id">دسته بندی</label>
                                            <select id="categorySelect" name="category_id" class="form-control"
                                                data-live-search="true">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"  {{ $category->id == $course->category->id ? 'selected' : '' }}>{{ $category->name }} -
                                                        {{ $category->parent->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="attributesContainer" class="col-md-12">
                                    <div id="attributes" class="row"></div>
                                </div>

                            </div>

                            <button id="send" class="btn btn-warning mt-3 mx-3 mb-3" type="submit">ویرایش</button>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary mt-3 mb-3">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript-code')
    <script>

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        $('#attributesContainer').hide();

        $('#categorySelect').on('changed.bs.select', function() {
            let categoryId = $(this).val();

            $.get(`{{ url('/admin-panel/management/category-attributes/${categoryId}') }}`, function(response,
                status) {
                if (status == 'success') {
                    // console.log(response);

                    $('#attributesContainer').fadeIn();

                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attributes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3 mt-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });

                    $('#variationName').text(response.variation.name);

                } else {
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function() {
                alert('مشکل در دریافت لیست ویژگی ها');
            })

            // console.log(categoryId);
        });

    </script>

@endsection
