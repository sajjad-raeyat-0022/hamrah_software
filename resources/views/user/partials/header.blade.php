@php
$authUser = Auth::user();

function redirect_to($url)
{
    if (!headers_sent()){
        header("Location: $url");
    }else{
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
    }
    exit;
}

$string_url = request()->url();

if (!empty($_GET['send_message'])) {
    $send_message = $_GET['send_message'];
}

if (!empty($_GET['message']) && $send_message == 'true') {
    if (!empty($_GET['message'])) {
        $message = $_GET['message'];
        App\Models\Chat::create([
            'from_id' => $authUser->id,
            'description' => $message,
        ]);
        redirect_to($string_url);
    }
}

@endphp
<header class="main-header bg-info">
    <div class="d-flex bd-highlight">
        <div class="d-flex bg-primary">

            <a href="#" class="logo bg-primary">
                <span class="logo-mini">پنل</span>
                <span class="logo-lg"><b>پنل کاربری</b></span>
            </a>
            <a href="#" class="sidebar-toggle text-center bg-info" data-toggle="push-menu" role="button"><span
                    class="sr-only">Toggle navigation</span></a>
        </div>
        <div class="flex-fill bd-highlight">
            <nav class="navbar d-flex justify-content-end bg-info">

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav flex-row">

                        @include('user.partials.chat')

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="@php
                                        if($authUser->avatar == null){
                                            echo '/img/2730042.png';
                                        }
                                        elseif($authUser->provider == 'google'){
                                            echo $authUser->avatar;
                                        }else{
                                            echo $authUser->avatar;
                                        }
                                        @endphp"
                                    class="user-image" alt="User Image">
                                <span
                                    class="hidden-xs">{{ $authUser->name == null ? $authUser->phone_number : $authUser->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="@php
                                        if($authUser->avatar == null){
                                            echo '/img/2730042.png';
                                        }
                                        elseif($authUser->provider == 'google'){
                                            echo $authUser->avatar;
                                        }else{
                                            echo $authUser->avatar;
                                        }
                                        @endphp"
                                        class="img-circle" alt="User Image">

                                    <p>
                                        {{ $authUser->name == null ? $authUser->phone_number : $authUser->name }}
                                        <small>کاربر</small>
                                        @role('management')
                                            <small>مدیریت کل سایت</small>
                                        @endrole
                                        @role('master')
                                            <small>مدرس دوره</small>
                                        @endrole
                                        @role('ta-master')
                                            <small>کمک یار مدرس</small>
                                        @endrole
                                    </p>
                                </li>

                                <li class="user-footer">
                                    @role('management')
                                    <div class="pull-right">
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-flat">پنل مدیریت</a>
                                    </div>
                                    @endrole
                                    @role('master')
                                    <div class="pull-right">
                                        <a href="{{ route('admin.courses.index') }}" class="btn btn-default btn-flat">پنل مدیریت</a>
                                    </div>
                                    @endrole
                                    @role('ta-master')
                                    <div class="pull-right">
                                        <a href="{{ route('admin.courses.index') }}" class="btn btn-default btn-flat">پنل مدیریت</a>
                                    </div>
                                    @endrole
                                    <div class="pull-left">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat">خروج</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
