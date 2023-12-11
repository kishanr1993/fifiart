<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">{{ translate('Login') }}</h6>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf

                        @if (addon_is_activated('otp_system'))
                                    <label class="display-block">
                                        <input class="account__login--input {{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{  translate('Phone') }}" type="tel" id="phone-code" value="{{ old('phone') }}" name="phone" autocomplete="off" />
                                    </label>
                                    <input type="hidden" name="country_code" value="" />

                                    <label class="display-block">
                                        <input class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{  translate('Email') }}" type="email" id="phone-code" value="{{ old('email') }}" name="email" id="email" autocomplete="off" />
                                            @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                    </label>

                                    <button class="account__login--btn primary__btn" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>

                                    @else

                                    <label class="display-block">
                                        <input class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{  translate('Email') }}" type="{{ old('email') }}" name="email" id="email" autocomplete="off" />
                                                @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                @endif
                                    </label>

                                    @endif

                                    <!-- password -->
                                    <label class="display-block">
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
                    </form>

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


<!-- Start News letter popup -->
<div class="loginmodal__popup" data-animation="slideInUp">
    <div class="loginmodal__popup--inner">
        <button class="loginmodal__popup--close__btn" aria-label="search close button">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path></svg>
        </button>
        <div class="box loginmodal__popup--box d-flex align-items-center">
            <div class="loginmodal__popup--thumbnail">
                <img class="loginmodal__popup--thumbnail__img display-block" src="{{ static_asset('assets/img/banner/newsletter-popup-thumb.png') }}" alt="loginmodal-popup-thumb">
            </div>
            <div class="loginmodal__popup--box__right">
                <h2 class="loginmodal__popup--title">{{ translate('Login') }}</h2>
                <div class="loginmodal__popup--content">
                    <label class="loginmodal__popup--content--desc">Enter your email address to subscribe our notification of our new post &amp; features by email.</label>
                    <div class="loginmodal__popup--subscribe" id="frm_subscribe">

                        <form class="loginmodal__popup--subscribe__form" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf
                            
                        @if (addon_is_activated('otp_system') && env('DEMO_MODE') != 'On')
                            
                            <!-- Phone -->
                            <input class="loginmodal__popup--subscribe__input {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="tel" id="phone-code"
                                   value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                            
                            <!-- Country Code -->
                            <input type="hidden" name="country_code" value="" class="m-t-5">
                            
                            <!-- Email -->
                            <input class="loginmodal__popup--subscribe__input m-t-5 {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"
                                   value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email"
                                   id="email" autocomplete="off">
                            
                        @else
                            
                            <!-- Use Email Instead -->
                            <input class="loginmodal__popup--subscribe__input {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"
                                   value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email"
                                   id="email" autocomplete="off">
                            
                        @endif
                            
                        <!-- Password -->
                        <input class="loginmodal__popup--subscribe__input m-t-5" type="password" name="password" placeholder="{{ translate('Password') }}">
                            
                        
                        <!-- Remember Me & Forgot password -->
                        <div class="loginmodal__popup--footer" style="text-align: left;">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="loginmodal__popup--dontshow__again--text" for="loginmodal__dont--show">{{ translate('Remember Me') }}</label>
                        </div>
                        
                        
                        <button class="loginmodal__popup--subscribe__btn" type="submit">{{ translate('Login') }}</button>
                            
                        </div>
                        </form>
                        <div class="loginmodal__popup--footer">
                            <a href="{{ route('password.request') }}"
                                   class="text-reset opacity-60 hov-opacity-100 fs-14">{{ translate('Forgot password?') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End News letter popup -->