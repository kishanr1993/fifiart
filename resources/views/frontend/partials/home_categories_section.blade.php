@if(get_setting('home_categories') != null)
@php $home_categories = json_decode(get_setting('home_categories')); @endphp
<!-- Start product section -->
<section class="product__section section--padding pt-0">
    <div class="container-fluid" id="new-products-section">
        <div class="section__heading text-center mb-30">
            <h2 class="section__heading--maintitle">Most Popular Items</h2>
        </div>
        <ul class="product__tab--btn d-flex justify-content-center mb-50">
            @foreach ($home_categories as $key1 => $value)
                @php $category = get_single_category($value); @endphp
                @if ($category)
            <li class="product__tab--btn__list @if($key1 == 0) active @endif" data-toggle="tab" data-target="#section{{ $category->id }}">{{ $category->getTranslation('name') }} </li>
                @endif
             @endforeach
        </ul>
        <div class="tab_content">
            @foreach ($home_categories as $key1 => $value)
                @php $category = get_single_category($value); @endphp
                @if ($category)
            <div id="section{{ $category->id }}" class="tab_pane @if($key1 == 0) active show @endif">
                <div class="product__section--inner">
                    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                                    @foreach (get_cached_products($category->id) as $key => $product)
                        <div class="col mb-30">
                                         @include('frontend.partials.product_box_1',['product' => $product])
                        </div>
                                    @endforeach
                    </div>
                </div>
            </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<!-- End product section -->
@endif