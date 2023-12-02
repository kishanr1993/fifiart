<div class="product__details--info">
    <!--<form action="#">-->
    <h2 class="product__details--info__title mb-15">{{ $detailedProduct->getTranslation('name') }}</h2>
    <div class="product__details--info__price mb-10">
        <span class="current__price">{{ home_discounted_price($detailedProduct) }}</span>
        <span class="old__price">{{ home_price($detailedProduct) }}</span>
        <!-- Unit -->
            @if ($detailedProduct->unit != null)
        <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>
            @endif
        <!-- Discount percentage -->
            @if (discount_in_percentage($detailedProduct) > 0)
        <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1"
              style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span>
            @endif

    </div>
    <div class="product__details--info__rating d-flex align-items-center mb-15">
            @php
                $total = 0;
                $total += $detailedProduct->reviews->count();
            @endphp
        <span class="rating rating-mr-1">
                {{ renderStarRating($detailedProduct->rating) }}
        </span>
        <span class="ml-1 opacity-50 fs-14">
            ({{ $total }}
                {{ translate('reviews') }})
        </span>
    </div>
    <p class="product__details--info__desc mb-20">{!! $detailedProduct->getTranslation('short_description') !!}</p>
    <div class="product__variant">
            @if ($detailedProduct->auction_product != 1)
        <form id="option-choice-form">
                @csrf
            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                @if ($detailedProduct->digital == 0)

            <!-- Color Options -->
                    @if ($detailedProduct->colors != null && count(json_decode($detailedProduct->colors)) > 0)
            <div class="product__variant--list mb-20">
                <fieldset class="variant__input--fieldset">
                    <legend class="product__variant--title mb-8">{{ translate('Color') }} :</legend>
                    <div class="variant__color d-flex">
                                    @foreach (json_decode($detailedProduct->colors) as $key => $color)
                        <div class="variant__color--list">
                            <input type="radio" name="color" id="color-{{ $key }}" value="{{ get_single_color_name($color) }}" @if ($key == 0) checked @endif>
                            <label class="variant__color--value red" for="color-{{ $key }}" title="{{ get_single_color_name($color) }}" style="background: {{ $color }};">
                                <!--<img class="variant__color--value__img" src="assets/img/product/product1.webp" alt="variant-color-img">-->
                            </label>
                        </div>
                                    @endforeach
                    </div>
                </fieldset>
            </div>
                    @endif

                    @if ($detailedProduct->digital == 0)
                        @if ($detailedProduct->choice_options != null)
                            @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

            <div class="product__variant--list mb-20">
                <fieldset class="variant__input--fieldset">
                    <legend class="product__variant--title mb-8">{{ get_single_attribute_name($choice->attribute_id) }} :</legend>
                    <ul class="variant__size d-flex">
                                            @foreach ($choice->values as $ckey => $value)
                        <li class="variant__size--list">
                            <input id="weight{{ $key }}-{{ $ckey }}" type="radio" name="attribute_id_{{ $choice->attribute_id }}"
                                   value="{{ $value }}"
                                                                    @if ($ckey == 0) checked @endif>
                            <label class="variant__size--value red" for="weight{{ $key }}-{{ $ckey }}">{{ $value }}</label>
                        </li>
                                            @endforeach
                    </ul>
                </fieldset>
            </div>
                        @endforeach
                    @endif

                @endif

            @endif
            <div class="product__variant--list quantity d-flex align-items-center mb-20">
                <div class="quantity__box">
                    <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                    <label>
                        <input type="number" class="quantity__number quickview__value--number" value="1" name="quantity" />
                    </label>
                    <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>
                </div>
                <button class="quickview__cart--btn primary__btn" type="button" @if (Auth::check()) onclick="addToCart()" @else onclick="showLoginModal()" @endif>{{ translate('Add to cart') }}</button>  
            </div>
            <div class="product__variant--list mb-15 inline-flex">
                <a class="variant__wishlist--icon mb-15" href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" title="{{ translate('Add to Compare') }}">
                    <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                        {{ translate('Add to Compare') }}
                </a>
                <a class="variant__wishlist--icon mb-15 m-l-15" href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" title="{{ translate('Add to Wishlist') }}">
                    <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
                        {{ translate('Add to Wishlist') }}
                </a>
            </div>
            <div class="product__variant--list mb-15">
                <button class="variant__buy--now__btn primary__btn" type="button" @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>
                    {{ translate('Buy Now') }}
                </button>
            </div>
            <div class="product__variant--list mb-15">
                <div class="product__details--info__meta">
                    <!-- Estimate Shipping Time -->
                    @if ($detailedProduct->est_shipping_days)
                    <p class="product__details--info__meta--list"><strong>{{ translate('Estimate Shipping Time') }}:</strong>  <span>{{ $detailedProduct->est_shipping_days }} {{ translate('Days') }}</span> </p>
                    @endif
                    <!-- In stock -->
                    @if ($detailedProduct->digital == 1)
                    <p class="product__details--info__meta--list"><strong>{{ translate('In stock') }}</strong></p>
                    @endif
                </div>
            </div>
                 @endif
        </form>
    </div>
    <div class="quickview__social d-flex align-items-center mb-15">
        <label class="quickview__social--title">{{ translate('Share') }}</label>
        <div class="aiz-share"></div>
    </div>
    <div class="guarantee__safe--checkout">
        <h5 class="guarantee__safe--checkout__title">Guaranteed Safe Checkout</h5>
        <img class="guarantee__safe--checkout__img" src="{{ static_asset('assets/img/other/safe-checkout.webp') }}" alt="Payment Image">
    </div>
    <!--</form>-->
</div>