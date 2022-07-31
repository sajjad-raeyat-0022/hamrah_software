<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>داشبرد | @section('title') dashboard @show </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="/img/MainLogo1.png" />
    @include('user.partials.link')

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('user.partials.header')

        @include('user.partials.sidebar')

        @yield('content')

        @include('user.partials.footer')

    </div>

    @include('user.partials.script')

    @include('sweet::alert')

    @yield('javascript-code')

</body>

</html>
