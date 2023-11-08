@extends('frontend.layouts.app')

@section('content')

<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">Account Page</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Account Page</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start login section  -->
    <div class="login__section section--padding">
        <div class="container">
            <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 mb--n30 justify-content-center">
                        <div class="col-6 align-self-center">
                            <div class="account__login">
                                <div class="account__login--header mb-25">
                                    <h3 class="account__login--header__title mb-10">{{ translate('Welcome Back !')}}</h3>
                                    <p class="account__login--header__desc">{{ translate('Login to your account')}}</p>
                                </div>
                                <div class="account__login--inner">
                                    @if (addon_is_activated('otp_system'))
                                    <label>
                                        <input class="account__login--input {{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{  translate('Phone') }}" type="tel" id="phone-code" value="{{ old('phone') }}" name="phone" autocomplete="off" />
                                    </label>
                                    <input type="hidden" name="country_code" value="" />

                                    <label>
                                        <input class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{  translate('Email') }}" type="email" id="phone-code" value="{{ old('email') }}" name="email" id="email" autocomplete="off" />
                                            @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                    </label>

                                    <button class="account__login--btn primary__btn" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>

                                    @else

                                    <label>
                                        <input class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{  translate('Email') }}" type="{{ old('email') }}" name="email" id="email" autocomplete="off" />
                                                @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                @endif
                                    </label>

                                    @endif

                                    <!-- password -->
                                    <label>
                                        <input class="account__login--input {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" type="password" name="password" id="password" />
                                    </label>


                                    <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" id="check1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                {{  translate('Remember Me') }}
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="account__login--forgot" type="submit">{{ translate('Forgot password?')}}</a>
                                    </div>
                                    <button class="account__login--btn primary__btn" type="submit">{{  translate('Login') }}</button>

                                    <!-- Social Login -->
                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                    <div class="account__login--divide">
                                        <span class="account__login--divide__text">OR</span>
                                    </div>
                                    <div class="account__social d-flex justify-content-center mb-15">

                                            @if (get_setting('facebook_login') == 1)
                                        <a class="account__social--link facebook" target="_blank" href="{{ route('social.login', ['provider' => 'facebook']) }}">Facebook</a>
                                            @endif

                                            @if(get_setting('google_login') == 1)
                                        <a class="account__social--link google" target="_blank" href="{{ route('social.login', ['provider' => 'google']) }}">Google</a>
                                            @endif

                                            @if (get_setting('twitter_login') == 1)
                                        <a class="account__social--link twitter" target="_blank" href="{{ route('social.login', ['provider' => 'twitter']) }}">Twitter</a>
                                            @endif

                                            @if (get_setting('apple_login') == 1)
                                        <a class="account__social--link apple" target="_blank" href="{{ route('social.login', ['provider' => 'apple']) }}">Twitter</a>
                                            @endif

                                    </div>
                                    @endif

                                    <!-- Register Now -->
                                    <p class="account__login--signup__text">{{ translate('Dont have an account?')}} <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a></p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>     
    </div>
    <!-- End login section  -->

    <!-- Start Newsletter banner section -->
    <section class="newsletter__banner--section section--padding pt-0">
        <div class="container">
            <div class="newsletter__banner--thumbnail position__relative">
                <img class="newsletter__banner--thumbnail__img" src="{{ static_asset('assets/img/banner/banner-bg7.webp') }}" alt="newsletter-banner">
                <div class="newsletter__content newsletter__subscribe">
                    <h5 class="newsletter__content--subtitle text-white">Want to offer regularly ?</h5>
                    <h2 class="newsletter__content--title text-white h3 mb-25">Subscribe Our Newsletter <br>
                        for Get Daily Update</h2>
                    <form class="newsletter__subscribe--form position__relative" action="{{ route('subscribers.store') }}">
                        @csrf
                        <label>
                            <input class="newsletter__subscribe--input" placeholder="{{ translate('Your Email Address') }}" type="email" name="email" required>
                        </label>
                        <button class="newsletter__subscribe--button primary__btn" type="submit">{{ translate('Subscribe') }}
                            <svg class="newsletter__subscribe--button__icon" xmlns="http://www.w3.org/2000/svg" width="9.159" height="7.85" viewBox="0 0 9.159 7.85">
                            <path  data-name="Icon material-send" d="M3,12.35l9.154-3.925L3,4.5,3,7.553l6.542.872L3,9.3Z" transform="translate(-3 -4.5)" fill="currentColor"/>
                            </svg>
                        </button>
                    </form>   
                </div>
            </div>
        </div>
    </section>
    <!-- End Newsletter banner section -->

</main>

@endsection

@section('script')
<script type="text/javascript">
    function autoFillSeller(){
        $('#email').val('seller@example.com');
        $('#password').val('123456');
    }

    function autoFillCustomer(){
        $('#email').val('customer@example.com');
        $('#password').val('123456');
    }
        
    function autoFillDeliveryBoy(){
        $('#email').val('deliveryboy@example.com');
        $('#password').val('123456');
    }
</script>
@endsection
