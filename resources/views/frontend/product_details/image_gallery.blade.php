@php
    $photos = [];
@endphp
@if ($detailedProduct->photos != null)
    @php
        $photos = explode(',', $detailedProduct->photos);
    @endphp
@endif

<div class="product__details--media">
    <div class="product__media--preview  swiper">
        <div class="swiper-wrapper">
            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                        <div class="swiper-slide">
                            <div class="product__media--preview__items">
                                <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="{{ uploaded_asset($stock->image) }}">
                                    <img class="product__media--preview__items--img" src="{{ uploaded_asset($stock->image) }}" alt="product-media-img">
                                </a>
                                <div class="product__media--view__icon">
                                    <a class="product__media--view__icon--link glightbox" href="{{ static_asset('assets/img/product/big-product1.webp') }}" data-gallery="product-media-preview">
                                        <svg class="product__media--view__icon--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                                        <span class="visually-hidden">Media Gallery</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            
            @foreach ($photos as $key => $photo)
                <div class="swiper-slide">
                    <div class="product__media--preview__items">
                        <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="{{ uploaded_asset($photo) }}">
                            <img class="product__media--preview__items--img" src="{{ uploaded_asset($photo) }}" alt="product-media-img">
                        </a>
                        <div class="product__media--view__icon">
                            <a class="product__media--view__icon--link glightbox" href="{{ uploaded_asset($photo) }}" data-gallery="product-media-preview">
                                <svg class="product__media--view__icon--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                                <span class="visually-hidden">Media Gallery</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="product__media--nav swiper">
        <div class="swiper-wrapper">
            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                        <div class="swiper-slide">
                            <div class="product__media--nav__items">
                                <img class="product__media--nav__items--img" src="{{ uploaded_asset($stock->image) }}" alt="product-nav-img">
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            
            @foreach ($photos as $key => $photo)
                <div class="swiper-slide">
                    <div class="product__media--nav__items">
                        <img class="product__media--nav__items--img" src="{{ uploaded_asset($photo) }}" alt="product-nav-img">
                    </div>
                </div>
            @endforeach

        </div>
        <div class="swiper__nav--btn swiper-button-next"></div>
        <div class="swiper__nav--btn swiper-button-prev"></div>
    </div>
</div>