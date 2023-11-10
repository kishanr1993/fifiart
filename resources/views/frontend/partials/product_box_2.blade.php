@php
    $cart_added = [];

    $product_url = route('product', $product->slug);
    if ($product->auction_product == 1) {
        $cart = get_user_cart();
        if (isset($cart) && count($cart) > 0) {
            $cart_added = $cart->pluck('product_id')->toArray();
        }
        $product_url = route('auction-product', $product->slug);
    }

@endphp

<div class="col mb-30">
    <div class="product__items product__list--items border-radius-5 d-flex align-items-center">
        <div class="product__list--items__left d-flex align-items-center">
            <div class="product__items--thumbnail product__list--items__thumbnail">
                <a class="product__items--link" href="{{ $product_url }}">
                    <img class="product__items--img product__primary--img" src="{{ $product->thumbnail != null ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="{{ $product->getTranslation('name') }}" title="{{ $product->getTranslation('name') }}" />
                    <img class="product__items--img product__secondary--img" src="{{ $product->thumbnail != null ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}" alt="{{ $product->getTranslation('name') }}" title="{{ $product->getTranslation('name') }}" />
                </a>
                <div class="product__badge">
                    <span class="product__badge--items sale">Sale</span>
                </div>
            </div>
            <div class="product__list--items__content">
                <!--<span class="product__items--content__subtitle mb-5">Wooden</span>-->
                <h4 class="product__list--items__content--title mb-15">
                    <a href="{{ $product_url }}" title="{{ $product->getTranslation('name') }}">{{ $product->getTranslation('name') }}</a>
                </h4>
                <p class="product__list--items__content--desc m-0">{{ $product->getTranslation('description') }}</p>
            </div>
        </div>
        <div class="product__list--items__right">

            @if ($product->auction_product == 0)
            <span class="product__list--current__price">{{ home_discounted_base_price($product) }}</span>
            <!-- Previous price -->
                @if (home_base_price($product) != home_discounted_base_price($product))
            <span class="old__price style2">{{ home_base_price($product) }}</span>
                @endif

            @endif

            <div class="product__list--action">
                <a class="product__list--action__cart--btn primary__btn" href="javascript:void(0)" @if (Auth::check()) onclick="showAddToCartModal({{ $product->id }})" @else onclick="showLoginModal()" @endif>
                    <svg class="product__list--action__cart--btn__icon" xmlns="http://www.w3.org/2000/svg" width="16.897" height="17.565" viewBox="0 0 18.897 21.565">
                        <path  d="M16.84,8.082V6.091a4.725,4.725,0,1,0-9.449,0v4.725a.675.675,0,0,0,1.35,0V9.432h5.4V8.082h-5.4V6.091a3.375,3.375,0,0,1,6.75,0v4.691a.675.675,0,1,0,1.35,0V9.433h3.374V21.581H4.017V9.432H6.041V8.082H2.667V21.641a1.289,1.289,0,0,0,1.289,1.29h16.32a1.289,1.289,0,0,0,1.289-1.29V8.082Z" transform="translate(-2.667 -1.366)" fill="currentColor"></path>
                    </svg>
                    <span class="product__list--action__cart--text">{{ translate('Add to Cart') }}</span>
                </a>

                <ul class="product__list--action__wrapper d-flex align-items-center">
                    <li class="product__list--action__child">
                        <a class="product__list--action__btn" data-open="modal1" href="{{ $product_url }}">
                            <svg class="product__list--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="30.51" height="25.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                            <span class="visually-hidden">Quick View</span>
                        </a>
                    </li>
                    <li class="product__list--action__child">
                        <a class="product__list--action__btn" href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" title="{{ translate('Add to wishlist') }}">
                            <svg class="product__list--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="24.403" height="20.204" viewBox="0 0 24.403 20.204">
                                <g  transform="translate(0)">
                                    <g  data-name="Group 473" transform="translate(0 0)">
                                        <path  data-name="Path 242" d="M17.484,35.514h0a6.858,6.858,0,0,0-5.282,2.44,6.765,6.765,0,0,0-5.282-2.44A6.919,6.919,0,0,0,0,42.434c0,6.549,11.429,12.943,11.893,13.19a.556.556,0,0,0,.618,0c.463-.247,11.893-6.549,11.893-13.19A6.919,6.919,0,0,0,17.484,35.514ZM12.2,54.388C10.41,53.338,1.236,47.747,1.236,42.434A5.684,5.684,0,0,1,6.919,36.75a5.56,5.56,0,0,1,4.757,2.564.649.649,0,0,0,1.05,0,5.684,5.684,0,0,1,10.441,3.12C23.168,47.809,13.993,53.369,12.2,54.388Z" transform="translate(0 -35.514)" fill="currentColor"/>
                                    </g>
                                </g>
                            </svg>
                            <span class="visually-hidden">{{ translate('Add to wishlist') }}</span>
                        </a>
                    </li>
                    <li class="product__list--action__child">
                        <a class="product__list--action__btn" href="javascript:void(0)" title="{{ translate('Add to compare') }}" onclick="addToCompare({{ $product->id }})">
                            <svg class="product__list--action__btn--svg"  xmlns="http://www.w3.org/2000/svg" width="25.654" height="18.388" viewBox="0 0 25.654 18.388">
                                <path  data-name="Path 287" d="M25.47,86.417l-3.334-3.334a.871.871,0,0,0-.62-.257H18.724a.476.476,0,0,0-.337.813l1.833,1.833H17.538l-3.77-3.77,3.77-3.77h2.683l-1.833,1.834a.476.476,0,0,0,.337.812h2.791a.881.881,0,0,0,.62-.257l3.335-3.335a.63.63,0,0,0,0-.887l-1.424-1.424a.376.376,0,1,0-.531.532l1.337,1.336L21.6,79.79a.124.124,0,0,1-.088.036H19.389l1.748-1.748a.526.526,0,0,0-.372-.9H17.382a.376.376,0,0,0-.266.11l-3.88,3.881-.9-.9,4.177-4.177a.633.633,0,0,1,.45-.187h3.8a.526.526,0,0,0,.372-.9L19.39,73.26h2.126a.125.125,0,0,1,.089.037l.665.665a.376.376,0,1,0,.531-.532l-.665-.664a.881.881,0,0,0-.621-.258H18.724a.476.476,0,0,0-.337.812l1.833,1.833H16.962a1.379,1.379,0,0,0-.982.407L11.8,79.737,7.627,75.56a1.38,1.38,0,0,0-.982-.407H.626A.627.627,0,0,0,0,75.78v1.525a.627.627,0,0,0,.626.626H6.069l3.77,3.77-3.77,3.77H.626A.627.627,0,0,0,0,86.1v1.525a.627.627,0,0,0,.626.626H6.644a1.384,1.384,0,0,0,.982-.407L11.8,83.666,13.135,85a.376.376,0,0,0,.531-.531L6.49,77.29a.376.376,0,0,0-.266-.11H.752V75.9H6.644a.633.633,0,0,1,.451.187L17.116,86.114a.376.376,0,0,0,.266.11h3.383a.526.526,0,0,0,.372-.9L19.39,83.578h2.126a.125.125,0,0,1,.089.037l3.246,3.246L21.6,90.107a.125.125,0,0,1-.089.037H19.39L21.137,88.4a.526.526,0,0,0-.372-.9h-3.8a.635.635,0,0,1-.451-.187l-1.605-1.605a.376.376,0,1,0-.531.531l1.606,1.606a1.382,1.382,0,0,0,.982.407H20.22l-1.833,1.833a.476.476,0,0,0,.337.813h2.792a.871.871,0,0,0,.62-.257L25.47,87.3A.628.628,0,0,0,25.47,86.417ZM7.1,87.311a.645.645,0,0,1-.451.187H.752V86.224H6.225a.376.376,0,0,0,.266-.11l3.88-3.88.9.9Z" transform="translate(0 -72.508)" fill="currentColor"/>
                            </svg>
                            <span class="visually-hidden">{{ translate('Add to compare') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
