@if (get_setting('best_selling') == 1 && count(get_best_selling_products(6)) > 0)
<!-- Start product section -->
<section class="product__section section--padding pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-12 product__col--width__8">
                <div class="product__section--wrapper">
                    <div class="section__heading style2 position__relative border-bottom mb-35">
                        <h2 class="section__heading--maintitle">{{ translate('Best Selling') }}</h2>
                        <img class="section__heading--position__img" src="{{ static_asset('assets/img/other/heading-shape-img.webp') }}" alt="heading-shape-img">
                    </div>
                    <div class="product__section--inner">
                        <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n25">
                            @foreach (get_best_selling_products(6) as $key => $product)
                                <div class="col mb-25">
                                    @include('frontend.partials.product_box_1',['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 offset-xl-0 col-lg-6 offset-lg-3 col-md-8  product__col--width__4">
                <div class="deals__banner--thumbnail">
                    <a class="deals__banner--thumbnail__link display-block position__relative" href="shop.html"><img class="deals__banner--thumbnail__img display-block" src="{{ static_asset('assets/img/banner/banner9.webp') }}" alt="deals-thumbnail-img">
                        <div class="deals__banner--content text-center">
                            <h2 class="deals__banner--content__maintitle h3">Bring Beauty With <br>
                                Furniture Tree </h2>
                            <div class="deals__banner--countdown d-flex justify-content-center" data-countdown="Sep 30, 2022 00:00:00"></div>
                            <span class="primary__btn style2">Order Now</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End product section -->
@endif
