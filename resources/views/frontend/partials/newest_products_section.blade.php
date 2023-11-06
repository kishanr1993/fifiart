@if (count($newest_products) > 0)
<!-- Start product section -->
<section class="product__section section--padding pt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-12 product__col--width__12">
                <div class="product__section--wrapper">
                    <div class="section__heading style2 position__relative border-bottom mb-35">
                        <h2 class="section__heading--maintitle">{{ translate('New Products') }}</h2>
                    </div>
                    <div class="product__section--inner">
                        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                            @foreach (get_best_selling_products(10) as $key => $product)
                            <div class="col mb-30">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary" href="{{ route('search',['sort_by'=>'newest']) }}">{{ translate('View All') }}</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End product section -->
@endif


