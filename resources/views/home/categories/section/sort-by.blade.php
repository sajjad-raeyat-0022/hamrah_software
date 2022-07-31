<div class="container" >
        <div class="toolbox  mb-3 gap-2">
            <div class="d-flex flex-wrap flex-grow-1 gap-1">
                <div class="">
                    <p class="mb-0 font-13  mx-2 mt-3"> مرتب سازی بر اساس : </p>
                    <select id="sort-by" class="form-select ms-3 rounded-0 text-left" onchange="filter()">
                        <option value="default"> پیش فرض </option>
                        <option value="max" {{ (request()->has('sortBy') && request()->sortBy == 'max') ? 'selected' : '' }}> بیشترین قیمت </option>
                        <option value="min" {{ (request()->has('sortBy') && request()->sortBy == 'min') ? 'selected' : '' }}> کم ترین قیمت </option>
                        <option value="latest" {{ (request()->has('sortBy') && request()->sortBy == 'latest') ? 'selected' : '' }}> جدید ترین </option>
                        <option value="oldest" {{ (request()->has('sortBy') && request()->sortBy == 'oldest') ? 'selected' : '' }}> قدیمی ترین </option>
                    </select>
                </div>
            </div>
        </div>

</div>
