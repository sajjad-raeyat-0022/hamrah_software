@extends('admin.layouts.admin')

@section('title')
    ایجاد دسته بندی
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
                    <!-- Horizontal Form -->
                    <div class="box box-success bg-light">
                        <div class="box-header with-border">
                            <h3 class="box-title">ایجاد دسته بندی</h3>
                        </div>
                        @include('partials.errors')
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">نام</label>
                                    <input class="form-control" id="name" name="name" type="text">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="slug">نام انگلیسی</label>
                                    <input class="form-control" id="slug" name="slug" type="text">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="parent_id">والد</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="0">بدون والد</option>
                                        @foreach ($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="is_active">وضعیت</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="attribute_ids">ویژگی</label>
                                    <select id="attributeSelect" name="attribute_ids[]" class="form-control" multiple
                                        data-live-search="true">
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="attribute_is_filter_ids">انتخاب ویژگی های اولیه قابل فیلتر</label>
                                    <select id="attributeIsFilterSelect" name="attribute_is_filter_ids[]" class="form-control" multiple
                                        data-live-search="true">
                                    </select>
                                </div>

                                {{-- <div class="form-group col-md-3">
                                    <label for="attribute_is_filter_ids">انتخاب نوع دوره</label>
                                    <select id="variationSelect" name="variation_id" class="form-control" data-live-search="true">
                                        <option value="video">ویدئویی</option>
                                        <option value="Article">مقاله ای</option>
                                    </select>
                                </div> --}}

                                <div class="form-group col-md-4">
                                    <label for="icon">آیکون</label>
                                    <input class="form-control" id="icon" name="icon" type="text">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">توضیحات</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>

                            </div>

                            <button class="btn btn-success mt-3 mb-5 mx-3" type="submit">ثبت</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3 mr-3 mb-5">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript-code')
    <script>
        $('#attributeSelect').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#attributeSelect').on('changed.bs.select', function() {
            let attributesSelected = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(attributesSelected , function(i,element){
                    if( attribute.id == element ){
                        attributeForFilter.push(attribute);
                    }
                });
            });

            $("#attributeIsFilterSelect").find("option").remove();
            $("#variationSelect").find("option").remove();
            attributeForFilter.forEach((element)=>{
                let attributeFilterOption = $("<option/>" , {
                    value : element.id,
                    text : element.name
                });

                // let variationOption = $("<option/>" , {
                //     value : element.id,
                //     text : element.name
                // });

                $("#attributeIsFilterSelect").append(attributeFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                // $("#variationSelect").append(variationOption);
                // $("#variationSelect").selectpicker('refresh');
            });


        });

        $("#attributeIsFilterSelect").selectpicker({
            'title': 'انتخاب ویژگی قابل فیلتر'
        });

        // $("#variationSelect").selectpicker({
        //     'title': 'انتخاب متغیر'
        // });
    </script>
@endsection
