<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hamrah Software | @section('title') home @show </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="/img/MainLogo1.png" />
    @yield('style')
    @include('home.partials.link')
    {!! SEO::generate() !!}
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper bg-white">

        @include('home.partials.header')

        @yield('content')

    </div>
    
    
    @include('home.partials.footer')


    @include('home.partials.script')

    @include('sweet::alert')

    @yield('javascript-code')

</body>

</html>
