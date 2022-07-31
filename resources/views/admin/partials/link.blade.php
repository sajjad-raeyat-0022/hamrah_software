<link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-theme.css') }}">
<link rel="stylesheet" href="{{ asset('/css/rtl.css') }}">
<link href="{{asset('/css/bootstrap-select.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{asset('https://pro.fontawesome.com/releases/v5.10.0/css/all.css')}}"" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{ asset('/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery-jvectormap.css') }}">
<link rel="stylesheet" href="{{ asset('/css/AdminLTE1.css') }}">
<link rel="stylesheet" href="{{ asset('/css/_all-skins.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('/css/jquery.md.bootstrap.datetimepicker.style.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery.Bootstrap-PersianDateTimePicker.css') }}" />
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" />
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#basic-conf',
        width: 600,
        height: 300,
        plugins: [
          'advlist autolink link image lists charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks code fullscreen insertdatetime media nonbreaking',
          'table emoticons template paste help'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
          'forecolor backcolor emoticons | help',
        menu: {
          favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });
</script>
