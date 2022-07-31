<form id="filter-form">
    @foreach ($attributes as $attribute)
        <input id="filter-attribute-{{ $attribute->id }}" type="hidden"
            name="attribute[{{ $attribute->id }}]">
    @endforeach
    <input id="filter-sort-by" type="hidden" name="sortBy">
    <input id="filter-search" type="hidden" name="search">
</form>
