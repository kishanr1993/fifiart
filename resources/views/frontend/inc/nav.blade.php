<!-- Top Bar Banner -->
@if (get_setting('topbar_banner') != null)
    <div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner"
        data-value="removed">
        <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
            <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="d-none d-xl-block img-fit" alt="{{ translate('topbar_banner') }}">
            <!-- For Large device -->
            <img src="{{ get_setting('topbar_banner_medium') != null ? uploaded_asset(get_setting('topbar_banner_medium')) : uploaded_asset(get_setting('topbar_banner')) }}"
                class="d-none d-md-block d-xl-none img-fit" alt="{{ translate('topbar_banner') }}"> <!-- For Medium device -->
            <img src="{{ get_setting('topbar_banner_small') != null ? uploaded_asset(get_setting('topbar_banner_small')) : uploaded_asset(get_setting('topbar_banner')) }}"
                class="d-md-none img-fit" alt="{{ translate('topbar_banner') }}"> <!-- For Small device -->
        </a>
        <button class="btn text-white h-100 absolute-top-right set-session" data-key="top-banner"
            data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
            <i class="la la-close la-2x"></i>
        </button>
    </div>
@endif

<!-- Start header area -->
<header class="header__section header__transparent">
            <!-- Start Header topbar -->
            <div class="header__topbar bg__primary">
                <div class="container-fluid">
                    <div class="header__topbar--inner d-flex align-items-center justify-content-between">
                        <div class="header__shipping">
                            <p class="header__shipping--text text-white">Get Up To 80% off In your first Offer!</p>
                        </div>
                        <div class="language__currency d-none d-lg-block">
                            <ul class="d-flex align-items-center">

                            <!-- Currency Switcher -->
                            @if (get_setting('show_currency_switcher') == 'on')
                                <li class="language__currency--list" id="currency-change">
                                @php   
                                    $system_currency = get_system_currency();  
                                @endphp
                                    <a class="account__currency--link text-white" href="#">
                                        <img src="{{ static_asset('assets/img/icon/usd-icon.webp') }}" alt="currency">
                                        <span>{{ $system_currency->name }}</span> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11.797" height="9.05" viewBox="0 0 9.797 6.05">
                                        <path  d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                        </svg>
                                    </a>
                                    <div class="dropdown__currency">
                                    <ul class="dropdown-menus">
                                        @foreach (get_all_active_currency() as $key => $currency)
                                            <li class="currency__items">
                                                <a class="currency__text @if ($system_currency->code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">
                                                    {{ $currency->name }} ({{ $currency->symbol }})
                                                </a>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            <!-- Language switcher -->
                            @if (get_setting('show_language_switcher') == 'on')
                                <li class="language__currency--list" id="lang-change">
                                @php
                                    $system_language = get_system_language();
                                @endphp
                                    <a class="language__switcher text-white" href="javascript:void(0)">
                                        <img class="language__switcher--icon__img" src="{{ static_asset('assets/img/icon/language-icon.webp') }}" alt="currency">
                                        <span>{{ $system_language->name }}</span> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11.797" height="9.05" viewBox="0 0 9.797 6.05">
                                        <path  d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                        </svg>
                                    </a>
                                    <div class="dropdown__language">
                                        <ul class="dropdown-menus">
                                        @foreach (get_all_active_language() as $key => $language)
                                            <li class="language__items">
                                                <a class="language__text" href="javascript:void(0)" data-flag="{{ $language->code }}">{{ $language->name }}</a>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Header topbar -->

            <!-- Start main header -->
            <div class="main__header header__sticky">
                <div class="container-fluid">
                    <div class="main__header--inner position__relative d-flex justify-content-between align-items-center">
                        <div class="offcanvas__header--menu__open ">
                            <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/></svg>
                                <span class="visually-hidden">Offcanvas Menu Open</span>
                            </a>
                        </div>
                        <div class="main__logo">
                            <h1 class="main__logo--title">
                                <a class="main__logo--link" href="{{ route('home') }}">
                                    @php
                                        $header_logo = get_setting('header_logo');
                                    @endphp
                                    @if ($header_logo != null)
                                        <img class="main__logo--img" src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}">
                                    @else
                                        <img class="main__logo--img" src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                                    @endif
                                </a>
                            </h1>
                        </div>
                        <div class="header__menu d-none d-lg-block">
                            <nav class="header__menu--navigation">
                                <ul class="d-flex">
                                   
                                    <li class="header__menu--items mega__menu--items">
                                        <a class="header__menu--link" href="#">Shop <span class="menu__plus--icon">+</span></a>
                                        @include('frontend.partials.category_menu')      
                                    </li>
                                    
                                    @if (get_setting('header_menu_labels') != null)
                                        @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                                            <li class="header__menu--items">
                                                <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}"
                                                    class="header__menu--link 
                                                @if (url()->current() == json_decode(get_setting('header_menu_links'), true)[$key]) active @endif">
                                                    {{ translate($value) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    
                                </ul>
                            </nav>
                        </div>
                        <div class="header__account">
                            <ul class="d-flex">
                                <li class="header__account--items  header__account--search__items d-md-none">
                                    <a class="header__account--btn search__open--btn" href="javascript:void(0)">
                                        <svg class="header__search--button__svg" xmlns="http://www.w3.org/2000/svg" width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"/></svg>  
                                        <span class="visually-hidden">Search</span>
                                    </a>
                                </li>

                                <li class="header__account--items d-md-none">
                                    <div class="" id="wishlist">
                                        @include('frontend.partials.wishlist')
                                    </div>               
                                </li>

                                <li class="header__account--items">
                                    @php
                                        $carts = array();
                                        if (auth()->user() != null) {
                                            $user_id = Auth::user()->id;
                                            $carts = get_user_cart();
                                        }
                                    @endphp
                                    <a class="header__account--btn minicart__open--btn" href="javascript:void(0)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18.897" height="21.565" viewBox="0 0 18.897 21.565">
                                        <path  d="M16.84,8.082V6.091a4.725,4.725,0,1,0-9.449,0v4.725a.675.675,0,0,0,1.35,0V9.432h5.4V8.082h-5.4V6.091a3.375,3.375,0,0,1,6.75,0v4.691a.675.675,0,1,0,1.35,0V9.433h3.374V21.581H4.017V9.432H6.041V8.082H2.667V21.641a1.289,1.289,0,0,0,1.289,1.29h16.32a1.289,1.289,0,0,0,1.289-1.29V8.082Z" transform="translate(-2.667 -1.366)" fill="currentColor"/>
                                        </svg>
                                        <span class="items__count">{{(isset($carts) && count($carts) > 0) ? count($carts) : 0 }}</span> 
                                    </a>
                                </li>
                                
                                @auth
                                    @if (isAdmin())
                                        <li class="header__account--items">
                                            <a class="header__account--btn" href="{{ route('admin.dashboard') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> 
                                                <span class="visually-hidden">{{ translate('Dashboard') }}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="header__account--items">
                                            <a class="header__account--btn" href="{{ route('dashboard') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> 
                                                <span class="visually-hidden">{{ translate('Dashboard') }}</span>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="header__account--items">
                                        <a class="header__account--btn" href="{{ route('logout') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 475.085 475.085">
                                            <path d="M237.545,255.816c9.899,0,18.468-3.609,25.696-10.848c7.23-7.229,10.854-15.799,10.854-25.694V36.547
                                                    c0-9.9-3.62-18.464-10.854-25.693C256.014,3.617,247.444,0,237.545,0c-9.9,0-18.464,3.621-25.697,10.854
                                                    c-7.233,7.229-10.85,15.797-10.85,25.693v182.728c0,9.895,3.617,18.464,10.85,25.694
                                                    C219.081,252.207,227.648,255.816,237.545,255.816z"/>
                                            <path d="M433.836,157.887c-15.325-30.642-36.878-56.339-64.666-77.084c-7.994-6.09-17.035-8.47-27.123-7.139
                                                    c-10.089,1.333-18.083,6.091-23.983,14.273c-6.091,7.993-8.418,16.986-6.994,26.979c1.423,9.998,6.139,18.037,14.133,24.128
                                                    c18.645,14.084,33.072,31.312,43.25,51.678c10.184,20.364,15.27,42.065,15.27,65.091c0,19.801-3.854,38.688-11.561,56.678
                                                    c-7.706,17.987-18.13,33.544-31.265,46.679c-13.135,13.131-28.688,23.551-46.678,31.261c-17.987,7.71-36.878,11.57-56.673,11.57
                                                    c-19.792,0-38.684-3.86-56.671-11.57c-17.989-7.71-33.547-18.13-46.682-31.261c-13.129-13.135-23.551-28.691-31.261-46.679
                                                    c-7.708-17.99-11.563-36.877-11.563-56.678c0-23.026,5.092-44.724,15.274-65.091c10.183-20.364,24.601-37.591,43.253-51.678
                                                    c7.994-6.095,12.703-14.133,14.133-24.128c1.427-9.989-0.903-18.986-6.995-26.979c-5.901-8.182-13.844-12.941-23.839-14.273
                                                    c-9.994-1.332-19.085,1.049-27.268,7.139c-27.792,20.745-49.344,46.442-64.669,77.084c-15.324,30.646-22.983,63.288-22.983,97.927
                                                    c0,29.697,5.806,58.054,17.415,85.082c11.613,27.028,27.218,50.34,46.826,69.948c19.602,19.603,42.919,35.215,69.949,46.815
                                                    c27.028,11.615,55.388,17.426,85.08,17.426c29.693,0,58.052-5.811,85.081-17.426c27.031-11.604,50.347-27.213,69.952-46.815
                                                    c19.602-19.602,35.207-42.92,46.818-69.948s17.412-55.392,17.412-85.082C456.809,221.174,449.16,188.532,433.836,157.887z"/>
                                            </svg> 
                                            <span class="visually-hidden">{{ translate('Logout') }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="header__account--items">
                                        <a class="header__account--btn" href="{{ route('user.login') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> 
                                            <span class="visually-hidden">My Account</span>
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End main header -->

            <!-- Start Offcanvas header menu -->
            <div class="offcanvas-header" tabindex="-1">
                <div class="offcanvas__inner">
                    <div class="offcanvas__logo">
                        <a class="offcanvas__logo_link" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if ($header_logo != null)
                            <img class="main__logo--img" src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}">
                        @else
                            <img class="main__logo--img" src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                        @endif
                        </a>
                        <button class="offcanvas__close--btn" aria-label="offcanvas close btn">close</button>
                    </div>
                    <nav class="offcanvas__menu">
                        <ul class="offcanvas__menu_ul">
                            <li class="offcanvas__menu_li">
                                <a class="offcanvas__menu_item" href="{{ route('home') }}">Home</a>       
                            </li>
                            <li class="offcanvas__menu_li">
                                <a class="offcanvas__menu_item" href="#">Shop</a>
                                @include('frontend.partials.category_menu_offcanvas')
                            </li>
                            
                        </ul>
                        <div class="offcanvas__account--items">
                            @auth
                                    @if (isAdmin())
                                        <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                                            <span class="offcanvas__account--items__icon"> 
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> 
                                            </span>                                            
                                            <span class="offcanvas__account--items__label">{{ translate('Dashboard') }}</span>
                                        </a>
                                    @else
                                        
                                        <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{ route('dashboard') }}">
                                            <span class="offcanvas__account--items__icon"> 
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> 
                                            </span>
                                            <span class="offcanvas__account--items__label">{{ translate('Dashboard') }}</span>
                                        </a>
                                        
                                    @endif

                                        <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{ route('logout') }}">
                                            <span class="offcanvas__account--items__icon"> 
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 475.085 475.085">
                                                    <path d="M237.545,255.816c9.899,0,18.468-3.609,25.696-10.848c7.23-7.229,10.854-15.799,10.854-25.694V36.547
                                                            c0-9.9-3.62-18.464-10.854-25.693C256.014,3.617,247.444,0,237.545,0c-9.9,0-18.464,3.621-25.697,10.854
                                                            c-7.233,7.229-10.85,15.797-10.85,25.693v182.728c0,9.895,3.617,18.464,10.85,25.694
                                                            C219.081,252.207,227.648,255.816,237.545,255.816z"/>
                                                    <path d="M433.836,157.887c-15.325-30.642-36.878-56.339-64.666-77.084c-7.994-6.09-17.035-8.47-27.123-7.139
                                                            c-10.089,1.333-18.083,6.091-23.983,14.273c-6.091,7.993-8.418,16.986-6.994,26.979c1.423,9.998,6.139,18.037,14.133,24.128
                                                            c18.645,14.084,33.072,31.312,43.25,51.678c10.184,20.364,15.27,42.065,15.27,65.091c0,19.801-3.854,38.688-11.561,56.678
                                                            c-7.706,17.987-18.13,33.544-31.265,46.679c-13.135,13.131-28.688,23.551-46.678,31.261c-17.987,7.71-36.878,11.57-56.673,11.57
                                                            c-19.792,0-38.684-3.86-56.671-11.57c-17.989-7.71-33.547-18.13-46.682-31.261c-13.129-13.135-23.551-28.691-31.261-46.679
                                                            c-7.708-17.99-11.563-36.877-11.563-56.678c0-23.026,5.092-44.724,15.274-65.091c10.183-20.364,24.601-37.591,43.253-51.678
                                                            c7.994-6.095,12.703-14.133,14.133-24.128c1.427-9.989-0.903-18.986-6.995-26.979c-5.901-8.182-13.844-12.941-23.839-14.273
                                                            c-9.994-1.332-19.085,1.049-27.268,7.139c-27.792,20.745-49.344,46.442-64.669,77.084c-15.324,30.646-22.983,63.288-22.983,97.927
                                                            c0,29.697,5.806,58.054,17.415,85.082c11.613,27.028,27.218,50.34,46.826,69.948c19.602,19.603,42.919,35.215,69.949,46.815
                                                            c27.028,11.615,55.388,17.426,85.08,17.426c29.693,0,58.052-5.811,85.081-17.426c27.031-11.604,50.347-27.213,69.952-46.815
                                                            c19.602-19.602,35.207-42.92,46.818-69.948s17.412-55.392,17.412-85.082C456.809,221.174,449.16,188.532,433.836,157.887z"/>
                                                </svg> 
                                            </span>
                                            <span class="offcanvas__account--items__label">{{ translate('Logout') }}</span>
                                        </a>
                                @else
                                    <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{ route('user.login') }}">
                                        <span class="offcanvas__account--items__icon"> 
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="26.51" height="23.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg> 
                                        </span>
                                        <span class="offcanvas__account--items__label">My Account</span>
                                    </a>
                                @endauth

                        </div>
                        <div class="language__currency">
                            <ul class="d-flex align-items-center">

                                <!-- Language switcher -->
                                @if (get_setting('show_language_switcher') == 'on')
                                    <li class="language__currency--list" id="lang-change">
                                    @php
                                        $system_language = get_system_language();
                                    @endphp
                                        <a class="offcanvas__language--switcher" href="javascript:void(0)">
                                            <img class="language__switcher--icon__img" src="{{ static_asset('assets/img/icon/language-icon.webp') }}" alt="currency">
                                            <span>{{ $system_language->name }}</span> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11.797" height="9.05" viewBox="0 0 9.797 6.05">
                                            <path  d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                            </svg>
                                        </a>
                                        <div class="offcanvas__dropdown--language">
                                            <ul class="dropdown-menus">
                                                @foreach (get_all_active_language() as $key => $language)
                                                    <li class="language__items">
                                                        <a class="language__text" href="javascript:void(0)" data-flag="{{ $language->code }}">{{ $language->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endif

                                <!-- Currency Switcher -->
                                @if (get_setting('show_currency_switcher') == 'on')
                                    <li class="language__currency--list" id="currency-change">
                                    @php   
                                        $system_currency = get_system_currency();  
                                    @endphp
                                        <a class="offcanvas__account--currency__menu" href="#">
                                            <img src="{{ static_asset('assets/img/icon/usd-icon.webp') }}" alt="currency">
                                            <span>{{ $system_currency->name }}</span> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11.797" height="9.05" viewBox="0 0 9.797 6.05">
                                            <path  d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                            </svg>
                                        </a>
                                        <div class="offcanvas__account--currency__submenu">
                                            <ul class="dropdown-menus">
                                                @foreach (get_all_active_currency() as $key => $currency)
                                                    <li class="currency__items">
                                                        <a class="currency__text @if ($system_currency->code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">
                                                            {{ $currency->name }} ({{ $currency->symbol }})
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endif


                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- End Offcanvas header menu -->

            <!-- Start Offcanvas stikcy toolbar -->
            <div class="offcanvas__stikcy--toolbar" tabindex="-1">
                <ul class="d-flex justify-content-between">
                    
                    @if (get_setting('header_menu_labels') != null)
                        @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                            <li class="offcanvas__stikcy--toolbar__list">
                                <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}"
                                    class="offcanvas__stikcy--toolbar__btn 
                                @if (url()->current() == json_decode(get_setting('header_menu_links'), true)[$key]) active @endif">
                                    <span class="offcanvas__stikcy--toolbar__label">{{ translate($value) }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                    
                    <li class="offcanvas__stikcy--toolbar__list ">
                        <a class="offcanvas__stikcy--toolbar__btn search__open--btn" href="javascript:void(0)">
                            <span class="offcanvas__stikcy--toolbar__icon"> 
                                <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"/></svg>   
                            </span>
                            <span class="offcanvas__stikcy--toolbar__label">Search</span>
                        </a>
                    </li>
                    <li class="offcanvas__stikcy--toolbar__list">
                         @php
                            $carts = array();
                            if (auth()->user() != null) {
                                $user_id = Auth::user()->id;
                                $carts = get_user_cart();
                            }
                        @endphp
                        <a class="offcanvas__stikcy--toolbar__btn minicart__open--btn" href="javascript:void(0)">
                            <span class="offcanvas__stikcy--toolbar__icon"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.51" height="15.443" viewBox="0 0 18.51 15.443">
                                <path  d="M79.963,138.379l-13.358,0-.56-1.927a.871.871,0,0,0-.6-.592l-1.961-.529a.91.91,0,0,0-.226-.03.864.864,0,0,0-.226,1.7l1.491.4,3.026,10.919a1.277,1.277,0,1,0,1.844,1.144.358.358,0,0,0,0-.049h6.163c0,.017,0,.034,0,.049a1.277,1.277,0,1,0,1.434-1.267c-1.531-.247-7.783-.55-7.783-.55l-.205-.8h7.8a.9.9,0,0,0,.863-.651l1.688-5.943h.62a.936.936,0,1,0,0-1.872Zm-9.934,6.474H68.568c-.04,0-.1.008-.125-.085-.034-.118-.082-.283-.082-.283l-1.146-4.037a.061.061,0,0,1,.011-.057.064.064,0,0,1,.053-.025h1.777a.064.064,0,0,1,.063.051l.969,4.34,0,.013a.058.058,0,0,1,0,.019A.063.063,0,0,1,70.03,144.853Zm3.731-4.41-.789,4.359a.066.066,0,0,1-.063.051h-1.1a.064.064,0,0,1-.063-.051l-.789-4.357a.064.064,0,0,1,.013-.055.07.07,0,0,1,.051-.025H73.7a.06.06,0,0,1,.051.025A.064.064,0,0,1,73.76,140.443Zm3.737,0L76.26,144.8a.068.068,0,0,1-.063.049H74.684a.063.063,0,0,1-.051-.025.064.064,0,0,1-.013-.055l.973-4.357a.066.066,0,0,1,.063-.051h1.777a.071.071,0,0,1,.053.025A.076.076,0,0,1,77.5,140.448Z" transform="translate(-62.393 -135.3)" fill="currentColor"/>
                                </svg> 
                            </span>
                            <span class="offcanvas__stikcy--toolbar__label">Cart</span>
                            <span class="items__count">{{(isset($carts) && count($carts) > 0) ? count($carts) : 0 }}</span> 
                        </a>
                    </li>
                    <li class="offcanvas__stikcy--toolbar__list">
                        <a class="offcanvas__stikcy--toolbar__btn" href="{{ route('wishlists.index') }}">
                            <span class="offcanvas__stikcy--toolbar__icon"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.541" height="15.557" viewBox="0 0 18.541 15.557">
                                <path  d="M71.775,135.51a5.153,5.153,0,0,1,1.267-1.524,4.986,4.986,0,0,1,6.584.358,4.728,4.728,0,0,1,1.174,4.914,10.458,10.458,0,0,1-2.132,3.808,22.591,22.591,0,0,1-5.4,4.558c-.445.282-.9.549-1.356.812a.306.306,0,0,1-.254.013,25.491,25.491,0,0,1-6.279-4.8,11.648,11.648,0,0,1-2.52-4.009,4.957,4.957,0,0,1,.028-3.787,4.629,4.629,0,0,1,3.744-2.863,4.782,4.782,0,0,1,5.086,2.447c.013.019.025.034.057.076Z" transform="translate(-62.498 -132.915)" fill="currentColor"/>
                                </svg> 
                            </span>
                            <span class="items__count wishlist__count">3</span> 
                            @if(Auth::check() && count(Auth::user()->wishlists)>0)
                                <span class="items__count wishlist__count">{{ count(Auth::user()->wishlists)}}</span> 
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Offcanvas stikcy toolbar -->

            <!-- Start offCanvas minicart -->
            <div class="offCanvas__minicart" tabindex="-1">
                <div class="minicart__header ">
                    <div class="minicart__header--top d-flex justify-content-between align-items-center">
                        <h3 class="minicart__title">{{ translate('Cart Items') }}</h3>
                        <button class="minicart__close--btn" aria-label="minicart close btn">
                            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"/></svg>
                        </button>
                    </div>
                    <p class="minicart__header--desc">Your cart items are here...</p>
                </div>
                <div class="minicart__product">
                    @php
                        $carts = array();
                        if (auth()->user() != null) {
                            $user_id = Auth::user()->id;
                            $carts = get_user_cart();
                        }

                        $total = 0;
                        if(count($carts) > 0) {
                            foreach ($carts as $key => $cartItem) {
                                $product = get_single_product($cartItem['product_id']);
                                $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];
                            }
                        }
                    @endphp
                    @if (isset($carts) && count($carts) > 0)
                        @foreach ($carts as $key => $cartItem)
                            @php
                                $product = get_single_product($cartItem['product_id']);
                            @endphp
                            @if ($product != null)
                                <div class="minicart__product--items d-flex">
                                    <div class="minicart__thumbnail">
                                        <a href="{{ route('product', $product->slug) }}">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                            class="img-fit lazyload size-60px has-transition"
                                            alt="{{ $product->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </a>
                                    </div>
                                    <div class="minicart__text">
                                        <h4 class="minicart__subtitle">
                                            <a href="{{ route('product', $product->slug) }}">
                                                {{ $product->getTranslation('name') }}
                                            </a>
                                        </h4>
                                        <span class="color__variant"><b>Quantity:</b> {{ $cartItem['quantity'] }}</span>
                                        <div class="minicart__price">
                                            <span class="current__price">{{ cart_product_price($cartItem, $product) }}</span>
                                        </div>
                                        <div class="minicart__text--footer d-flex align-items-center">
                                            <button class="minicart__product--remove" aria-label="minicart remove btn" type="button" onclick="removeFromCart({{ $cartItem['id'] }})">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="minicart__product--items d-flex text-center">
                            <h3 class="h6 fw-700">{{ translate('Your Cart is empty') }}</h3>
                        </div>
                    @endif
                </div>
                <div class="minicart__amount">
                    <div class="minicart__amount_list d-flex justify-content-between">
                        <span>{{ translate('Subtotal') }}:</span>
                        <span><b>{{ single_price($total) }}</b></span>
                    </div>
                </div>
                <div class="minicart__conditions text-center">
                    <label class="minicart__conditions--label" for="accept"><a class="minicart__conditions--link" href="privacy-policy.html">Privacy And Policy</a></label>
                </div>
                <div class="minicart__button d-flex justify-content-center">
                    <a class="primary__btn minicart__button--link" href="{{ route('cart') }}">{{ translate('View cart') }}</a>
                    @if (Auth::check())
                        <a class="primary__btn minicart__button--link" href="{{ route('checkout.shipping_info') }}">{{ translate('Checkout') }}</a>
                    @endif
                </div>
            </div>
            <!-- End offCanvas minicart -->

            <!-- Start serch box area -->
            <div class="predictive__search--box " tabindex="-1">
                <div class="predictive__search--box__inner">
                    <h2 class="predictive__search--title">Search Products</h2>
                    <form action="{{ route('search') }}" method="GET" class="predictive__search--form">
                        <label>
                            <input type="text" class="predictive__search--input" id="search" name="keyword" placeholder="{{ translate('I am shopping for...') }}" autocomplete="off"
                                            @isset($query)
                                            value="{{ $query }}"
                                        @endisset
                                            />
                        </label>
                        <button class="predictive__search--button" aria-label="search button"><svg class="header__search--button__svg" xmlns="http://www.w3.org/2000/svg" width="30.51" height="25.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"/></svg>  </button>
                    </form>
                    <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                                style="min-height: 200px">
                        <div class="search-preloader absolute-top-center">
                            <div class="dot-loader">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="search-nothing d-none p-3 text-center fs-16">

                        </div>
                        <div id="search-content" class="text-left">

                        </div>
                    </div>
                </div>
                <button class="predictive__search--close__btn" aria-label="search close btn">
                    <svg class="predictive__search--close__icon" xmlns="http://www.w3.org/2000/svg" width="40.51" height="30.443"  viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"/></svg>
                </button>
            </div>
            <!-- End serch box area -->
        </header>
        <!-- End header area -->    
    

    @section('script')
        <script type="text/javascript">
            function show_order_details(order_id) {
                $('#order-details-modal-body').html(null);

                if (!$('#modal-size').hasClass('modal-lg')) {
                    $('#modal-size').addClass('modal-lg');
                }

                $.post('{{ route('orders.details') }}', {
                    _token: AIZ.data.csrf,
                    order_id: order_id
                }, function(data) {
                    $('#order-details-modal-body').html(data);
                    $('#order_details').modal();
                    $('.c-preloader').hide();
                    AIZ.plugins.bootstrapSelect('refresh');
                });
            }
        </script>
    @endsection
