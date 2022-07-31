<aside class="main-sidebar ">
    <section class="sidebar">
        <br>
        <!--<form action="#" method="get" class="sidebar-form mt-3">-->
        <!--    <div class="input-group">-->
        <!--        <input type="text" name="q" class="form-control" placeholder="جستجو">-->
        <!--        <span class="input-group-btn">-->
        <!--            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i-->
        <!--                    class="fa fa-search"></i>-->
        <!--            </button>-->
        <!--        </span>-->
        <!--    </div>-->
        <!--</form>-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">منو</li>
            <li class="{{ request()->is('user-profile') ? 'active' : '' }}"><a
                    href="{{ route('user.users_profile.index') }}"><i class="fa fa-dashboard"></i>
                    <span>پروفایل</span></a></li>

            <li class="treeview">
                <a href="#">
                    <i class="fas fa-shopping-cart mx-3"></i>
                    <span>سفارشات</span>
                    <span class="pull-left-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('user-profile/cart') ? 'active' : '' }}"><a
                        href="{{ route('user.users_profile.cart') }}"><i class="fas fa-cart-plus"></i> سبد خرید</a>
                </li>
                    <li class="{{ request()->is('user-profile/orders') ? 'active' : '' }}"><a
                            href="{{ route('user.users_profile.orders') }}"><i class="fas fa-cart-arrow-down"></i> سفارشات</a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('user-profile/addresses') ? 'active' : '' }}"><a
                    href="{{ route('user.users_profile.addresse') }}"><i class="fas fa-map-marker-alt mx-3"></i>
                    <span>آدرس ها</span></a></li>
            <li class="{{ request()->is('user-profile/order-items') ? 'active' : '' }}"><a
                    href="{{ route('user.users_profile.orderItems') }}"><i class="fas fa-book mx-3"></i>
                    <span>دوره های من</span></a></li>
            <li class="{{ request()->is('user-profile/order-items/certificate') ? 'active' : '' }}"><a
                    href="{{ route('user.certificate.index') }}"><i class="fas fa-book mx-3"></i>
                    <span>نمرات و مدارک دوره</span></a></li>
            <li class="{{ request()->is('user-profile/favoritelist') ? 'active' : '' }}"><a
                    href="{{ route('user.users_profile.favoritelist') }}"><i class="fas fa-bookmark mx-3"></i>
                    <span>لیست علاقه مندی ها</span></a></li>
                    <li class="{{ request()->is('user-profile/compare') ? 'active' : '' }}"><a
                    href="{{ route('user.users_profile.compare') }}"><i class="fas fa-sync-alt mx-3"></i>
                    <span>مقایسه دوره ها</span></a></li>
            <li class="{{ request()->is('user-profile/comments') ? 'active' : '' }}"><a
                    href="{{ route('user.users_profile.comments') }}"><i class="fas fa-comments mx-3"></i>
                    <span>دیدگاه ها</span></a></li>
            <li><a href="{{ route('index') }}"><i class="fas fa-home mx-3"></i>
                    <span>صفحه خانه</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
