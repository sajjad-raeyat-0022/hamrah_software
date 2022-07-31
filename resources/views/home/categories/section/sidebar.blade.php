<aside class="main-sidebar mr-5" id="sidebarFilter">
    <section class="sidebar">
        <div class="text-center">
            <a class="btn btn-flat arrow-right" onclick="closeFilterSidebar()"><i class="fas fa-arrow-right"></i></a>

        </div>

            <div class="input-group">
                <input id="search-input" type="text" class="form-control" placeholder="جستجو" value="{{ request()->has('search') ? request()->search : ''}}">
                <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn btn-flat input-group-text cursor-pointer" onclick="filter()"><i class="fa fa-search"></i></button>
                </span>
            </div>
            @include('home.categories.section.sort-by')

            <hr>
            <ul class="" data-widget="tree">
                <div class="product-categories">
                    <h6 class="text-uppercase mb-3">دسته بندی</h6>
                    <ul class="list-unstyled mb-0 categories-list">
                        <h6> {{ $category->parent->name }} </h6>
                        @foreach ($category->parent->children as $childCategory)
                            <li><a
                                    href="{{ route('home.categories.show', ['category' => $childCategory->slug]) }}">{{ $childCategory->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr>
                @foreach ($attributes as $key1 => $attribute)
                    <div class="title-sidebar">
                        <h6 class="text-uppercase mb-3">{{ $attribute->name }}</h6>
                        <ul class="list-unstyled mb-0 categories-list">
                            @foreach ($attribute->values as $key2 => $value)
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input attribute-{{ $attribute->id }}" type="checkbox"
                                            value="{{ $value->value }}" id="Attribute-{{ $key1 . '-' . $key2 }}"
                                            onchange="filter()"
                                            {{ request()->has('attribute.' . $attribute->id) && in_array($value->value, explode('-', request()->attribute[$attribute->id])) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="Attribute-{{ $key1 . '-' . $key2 }}">{{ $value->value }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                @endforeach

            </ul>


        @include('home.categories.section.filter-form')

    </section>
</aside>
<div class="filter-sidebar ">
    <br><br>
    <a class="arrow-left " onclick="openFilterSidebar()"><i class="fas fa-arrow-left mx-5"></i></a>
</div>
