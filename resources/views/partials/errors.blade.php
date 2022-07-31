@if(count($errors) > 0)
<div clss="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li class="alert-text text-danger">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
