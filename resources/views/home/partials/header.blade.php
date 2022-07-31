<header>
    <div class="fas fa-bars"></div>

    <nav class="navbar">
        <ul class="ul1">
            <li><a href="{{ route('index') }}" class="{{ request()->is('/') ? 'active' : '' }}">خانه</a></li>

            <li><a href="{{ route('home.about-us') }}" class="{{ request()->is('about-us') ? 'active' : '' }}">درباره ما</a></li>
            <li><a href="{{ route('home.contact-us') }}" class="{{ request()->is('contact-us') ? 'active' : '' }}">تماس با ما</a></li>
            <li><a href="{{ route('index') }}#course" class="">دسته بندی ها</a></li>
            <li><a href="{{ route('index') }}#new_course" class="">جدید ترین ها</a></li>
        </ul>
    </nav>
    <div class="d-flex justify-content-end">
        @auth
         @if(Auth::user()->status != 3)
            <nav class=" navbar-expand">

                <ul class="navbar-nav ms-auto text-center">

                    <li class="nav-item dropdown dropdown-large">

                        <a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative cart-link"
                            data-toggle="dropdown">
                            @if (!\Cart::session(auth()->id())->isEmpty())
                                <span
                                    class="cart-price">{{ number_format(\Cart::session(auth()->id())->getTotal()) }}</span>
                                <span>تومان</span>
                                <span
                                    class="badge  mr-2 bg-danger">{{ \Cart::session(auth()->id())->getContent()->count() }}</span>
                            @endif

                            <i class="fas fa-shopping-cart fa-lg mx-2 text-success mt-3"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">

                            <a href="#">
                                <div class="cart-header bg-primary">
                                    <b class="cart-header-clear ms-auto mb-0">سبد خرید</b>
                                </div>
                            </a>

                            @if (\Cart::session(auth()->id())->isEmpty())
                                <div class="dropdown-item d-flex justify-content-center text-danger">
                                    <p>سبد خرید شما خالی میباشد</p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img src="/img/empty-cart.png" style="height: 150px; width: 200px;" alt="empty">
                                </div>
                                <div class="d-grid p-3 border-top"> <a href="#"
                                        class="btn btn-outline-danger btn-ecomm">خروج</a>
                                </div>
                            @else
                                <div class="cart-list">

                                    @foreach (\Cart::session(auth()->id())->getContent() as $item)
                                        <a class="dropdown-item"
                                            href="{{ route('home.courses.show', ['course' => $item->associatedModel->slug]) }}">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="cart-product-title text-black">{{ $item->name }}</h6>
                                                    <p class="cart-product-price text-danger">
                                                        {{ number_format($item->price) }} تومان</p>
                                                    @if ($item->associatedModel->is_sale)
                                                        <p class="cart-product-price text-danger">تخفیف :
                                                            {{ number_format($item->associatedModel->persent_sale) }}%
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="position-relative mt-2">
                                                    <div class="cart-product-cancel position-absolute">
                                                        <a
                                                            href="{{ route('user.users_profile.cart.remove', ['rowId' => $item->id]) }}"><i
                                                                class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    </div>
                                                    <div class="cart-product">
                                                        <img style="height: 50px; width:50px;"
                                                            src="{{ asset(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $item->associatedModel->primary_image) }}"
                                                            class=""
                                                            alt="{{ $item->associatedModel->primary_image }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                                <div class="d-grid p-3 border-top"> <a href="{{ route('user.users_profile.cart') }}"
                                        class="btn btn-outline-primary btn-ecomm">سبد خرید</a>
                                </div>
                            @endif
                        </div>

                    </li>

                </ul>

            </nav>
            @endif
            <nav class="navbar">
                @if(Auth::user()->status != 3)
                <a href="{{ route('user.users_profile.index') }}" type="button" class="mx-4"><i
                        class="fas fa-user fa-lg mt-3"></i></a>
                @endif
                @role('master|ta-master')
                    <a href="{{ route('admin.courses.index') }}" type="button" class="mx-4"><i class="fas fa-user-tie fa-lg mx-2 mt-3"></i></a>
                @endrole
                @role('management')
                    <a href="{{ route('admin.dashboard') }}" type="button" class="mx-4"><i class="fas fa-user-tie fa-lg mx-2 mt-3"></i></a>
                @endrole
            </nav>

        @else
            <nav class="navbar">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-danger" href="{{ route('register') }}">
                        ثبت نام <i class="fas fa-user-plus"></i>
                    </a>
                    <a class="btn btn-danger" href="{{ route('login') }}">
                        ورود <i class="fas fa-user-check"></i>
                    </a>
                </div>
            </nav>
        @endauth
        <div class="">
            <a href="#" class="logo"><img src="/img/MainLogo2.png" alt=""></a>
        </div>
    </div>
</header>
