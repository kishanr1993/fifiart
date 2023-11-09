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
            <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1 mb--n30 justify-content-center">
                       <div class="col">
                            <div class="account__login register">
                                <div class="account__login--header mb-25">
                                    <h3 class="account__login--header__title mb-10">{{ translate('Create an account')}}</h3>
                                    <p class="account__login--header__desc">Register here if you are a new customer</p>
                                </div>
                                <div class="account__login--inner">

                                    <!-- Name -->
                                    <label>
                                        <input type="text" class="account__login--input {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </label>

                                    <!-- Email or Phone -->
                                    @if (addon_is_activated('otp_system'))

                                    <label>
                                        <input type="tel" id="phone-code" class="account__login--input {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                    </label>
                                    <input type="hidden" name="country_code" value="">

                                    <label>
                                        <input type="email" class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">
                                            @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                    </label>

                                    <label>
                                        <button class="account__login--btn primary__btn mb-10" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                                    </label>

                                    @else

                                    <label>
                                        <input type="email" class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                            @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                    </label>

                                    @endif

                                    <!-- password -->
                                    <label>
                                        <input type="password" class="account__login--input {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                        <div class="text-right mt-1">
                                            <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>
                                        </div>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </label>

                                    <!-- password Confirm -->
                                    <label>
                                        <input type="password" class="account__login--input" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                    </label>

                                    @if(get_setting('google_recaptcha') == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                    </div>
                                        @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                        @endif
                                    @endif

                                    <div class="account__login--remember position__relative">
                                        <input class="checkout__checkbox--input" id="check2" type="checkbox" name="checkbox_example_1" required>
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label login__remember--label" for="check2">
                                            {{ translate('By signing up you agree to our ')}} <a href="{{ route('terms') }}" class="fw-500">{{ translate('terms and conditions.') }}</a>
                                        </label>
                                    </div>

                                    <label>
                                        <button class="account__login--btn primary__btn mb-10" type="submit">{{  translate('Create Account') }}</button>
                                    </label>
                                </div>
                                
                                <!-- Login Now -->
                                <p class="account__login--signup__text">{{ translate('Already have an account?')}} <a href="{{ route('user.login') }}">{{ translate('Log In')}}</a></p>
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
    @if(get_setting('google_recaptcha') == 1)
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

<script type="text/javascript">

    @if(get_setting('google_recaptcha') == 1)
    // making the CAPTCHA  a required field for form submission
    $(document).ready(function(){
        $("#reg-form").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("please verify you are humann!");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#reg-form").submit();
        });
    });
    @endif
</script>
@endsection
