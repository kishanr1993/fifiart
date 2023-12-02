<!-- Start product section -->
<section class="product__section section--padding">
    <div class="container">
        <div class="section__heading text-center mb-40">
            <h2 class="section__heading--maintitle">{{ translate('Related products') }}</h2>
        </div>
        <div class="product__section--inner product__swiper--column4 swiper">
            <div class="swiper-wrapper">
                @foreach (get_related_products($detailedProduct) as $key => $related_product)
                    <div class="swiper-slide">
                        <div class="product__items ">
                            <div class="product__items--thumbnail">
                                <a class="product__items--link" href="{{ route('product', $related_product->slug) }}">
                                    <img class="product__items--img product__primary--img" src="{{ uploaded_asset($related_product->thumbnail_img) }}" alt="{{ $related_product->getTranslation('name') }}" />
                                    <img class="product__items--img product__secondary--img" src="{{ uploaded_asset($related_product->thumbnail_img) }}" alt="{{ $related_product->getTranslation('name') }}" />
                                </a>
                            </div>
                            <div class="product__items--content text-center">
                                <div class="product__items--color">
                                    <ul class="product__items--color__wrapper d-flex justify-content-center">
                                        <li class="product__items--color__list"><a class="product__items--color__link one" href="javascript:void(0)"><span class="visually-hidden">Color 1</span></a></li>
                                        <li class="product__items--color__list"><a class="product__items--color__link two" href="javascript:void(0)"><span class="visually-hidden">Color 2</span></a></li>
                                        <li class="product__items--color__list"><a class="product__items--color__link three" href="javascript:void(0)"><span class="visually-hidden">Color 3</span></a></li>
                                        <li class="product__items--color__list"><a class="product__items--color__link four" href="javascript:void(0)"><span class="visually-hidden">Color 4</span></a></li>
                                    </ul>
                                </div>
                                <h3 class="product__items--content__title h4"><a href="{{ route('product', $related_product->slug) }}">{{ $related_product->getTranslation('name') }}</a></h3>
                                <div class="product__items--price">
                                    <span class="current__price">{{ home_discounted_base_price($related_product) }}</span>
                                    @if (home_base_price($related_product) != home_discounted_base_price($related_product))
                                        <span class="old__price">{{ home_base_price($related_product) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
            <div class="swiper__nav--btn swiper-button-next"></div>
            <div class="swiper__nav--btn swiper-button-prev"></div>
        </div>
    </div>
</section>
<!-- End product section -->