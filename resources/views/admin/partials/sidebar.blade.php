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
            @can('dashboard-management')
                <li class="{{ request()->is('admin-panel/dashboard') ? 'active' : '' }}"><a
                        href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>داشبرد</span></a></li>
            @endcan
            @can('user-management')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>کاربران</span>
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->is('admin-panel/management/users') ? 'active' : '' }}"><a
                                href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> کاربران سایت</a>
                        </li>
                        @can('roles-management')
                            <li class="{{ request()->is('admin-panel/management/roles') ? 'active' : '' }}"><a
                                    href="{{ route('admin.roles.index') }}"><i class="fas fa-user-tag"></i> نقش کاربری</a></li>
                        @endcan
                        @can('permission-management')
                            <li class="{{ request()->is('admin-panel/management/permissions') ? 'active' : '' }}"><a
                                    href="{{ route('admin.permissions.index') }}"><i class="fas fa-user-shield"></i> مجوز ها</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @role('master|ta-master|management')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>دوره های آموزشی</span>
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('courses')
                            <li class="{{ request()->is('admin-panel/management/courses') ? 'active' : '' }}"><a
                                    href="{{ route('admin.courses.index') }}"><i class="fa fa-book"></i>لیست دوره های
                                    آموزشی</a></li>
                        @endcan
                        @can('exams')
                            <li class="{{ request()->is('admin-panel/management/exams') ? 'active' : '' }}"><a
                                    href="{{ route('admin.exams.index') }}"><i class="fas fa-pencil-ruler"></i> امتحانات </a></li>
                        @endcan
                        @can('categories')
                            <li class="{{ request()->is('admin-panel/management/categories') ? 'active' : '' }}"><a
                                    href="{{ route('admin.categories.index') }}"><i class="fas fa-swatchbook"></i> دسته بندی
                                    ها</a></li>
                        @endcan
                        @can('attributes')
                            <li class="{{ request()->is('admin-panel/management/attributes') ? 'active' : '' }}"><a
                                    href="{{ route('admin.attributes.index') }}"><i class="fas fa-file-signature"></i> ویژگی ها</a>
                            </li>
                        @endcan
                        @can('tags')
                            <li class="{{ request()->is('admin-panel/management/tags') ? 'active' : '' }}"><a
                                    href="{{ route('admin.tags.index') }}"><i class="fas fa-tags"></i> تگ ها </a></li>
                        @endcan
                        @can('comment-management')
                            <li class="{{ request()->is('admin-panel/management/comments') ? 'active' : '' }}"><a
                                    href="{{ route('admin.comments.index') }}"><i class="fas fa-comments"></i> کامنت ها</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endrole

            @can('orders-management')
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-shopping-cart mx-3"></i>
                        <span>سفارشات</span>
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->is('admin-panel/management/orders') ? 'active' : '' }}"><a
                                href="{{ route('admin.orders.index') }}"><i class="fas fa-cart-plus"></i> سفارشات</a></li>
                        @can('transaction-management')
                            <li class="{{ request()->is('admin-panel/management/transactions') ? 'active' : '' }}"><a
                                    href="{{ route('admin.transactions.index') }}"><i class="fas fa-cart-arrow-down"></i> تراکنش
                                    ها</a></li>
                        @endcan
                        @can('coupon-management')
                            <li class="{{ request()->is('admin-panel/management/coupons') ? 'active' : '' }}"><a
                                    href="{{ route('admin.coupons.index') }}"><i class="fas fa-receipt"></i> کد های تخفیف</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('banners')
                <li class="{{ request()->is('admin-panel/management/banners') ? 'active' : '' }}"><a
                        href="{{ route('admin.banners.index') }}"><i class="fa fa-image"></i> <span>بنر ها</span></a>
                </li>
            @endcan
            <li><a href="{{ route('index') }}"><i class="fas fa-home mx-3"></i>
                    <span>صفحه خانه</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
