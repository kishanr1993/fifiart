@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = get_single_category($category_id)->meta_title;
        $meta_description = get_single_category($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = get_single_brand($brand_id)->meta_title;
        $meta_description = get_single_brand($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title }}">
<meta itemprop="description" content="{{ $meta_description }}">

<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_description }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container-fluid">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">Shop Wth US</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{ route('home') }}">{{ translate('Home')}}</a></li>

                            @if(!isset($category_id))
                            <li class="breadcrumb__content--menu__items">
                                "{{ translate('All Categories')}}"
                            </li>
                                    @else
                            <li class="breadcrumb__content--menu__items">
                                <a class="text-white" href="{{ route('search') }}">{{ translate('All Categories')}}</a>
                            </li>
                            @endif

                            @if(isset($category_id))
                            <li class="breadcrumb__content--menu__items">
                                "{{ get_single_category($category_id)->getTranslation('name') }}"
                            </li>
                            @endif

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start shop section -->
    <section class="shop__section section--padding">
            <form class="" id="search-form" action="" method="GET">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="shop__sidebar--widget widget__area d-md-none">
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title position__relative h3">{{ translate('Categories')}}</h2>
                            <ul class="widget__categories--menu">
                                    @if (!isset($category_id))
                                         @foreach (get_level_zero_categories() as $category)
                                <li class="widget__categories--menu__list">
                                    <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{ route('products.category', $category->slug) }}">
                                        <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                        <span class="widget__categories--sub__menu--text">{{ $category->getTranslation('name') }}</span>
                                    </a>

                                </li>
                                        @endforeach
                                    @else

                                <li class="widget__categories--menu__list">
                                    <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{ route('search') }}">
                                        <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                        <span class="widget__categories--sub__menu--text">{{ translate('All Categories')}}</span>
                                    </a>

                                </li>

                                         @if (get_single_category($category_id)->parent_id != 0)

                                <li class="widget__categories--menu__list">
                                    <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{ route('products.category', get_single_category(get_single_category($category_id)->parent_id)->slug) }}">
                                        <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                        <span class="widget__categories--sub__menu--text">{{ get_single_category(get_single_category($category_id)->parent_id)->getTranslation('name') }}</span>
                                    </a>

                                </li>

                                        @endif

                                <li class="widget__categories--menu__list">
                                    <label class="widget__categories--menu__label d-flex align-items-center">
                                        <img class="widget__categories--menu__img" src="assets/img/product/small-product5.webp" alt="categories-img">
                                        <span class="widget__categories--menu__text">{{ get_single_category($category_id)->getTranslation('name') }}</span>
                                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                                        <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                                        </svg>
                                    </label>
                                    <ul class="widget__categories--sub__menu">
                                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category_id) as $key => $id)
                                        <li class="widget__categories--sub__menu--list">
                                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{ route('products.category', get_single_category($id)->slug) }}">
                                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                                <span class="widget__categories--sub__menu--text">{{ get_single_category($id)->getTranslation('name') }}</span>
                                            </a>
                                        </li>
                                                @endforeach
                                    </ul>
                                </li>

                                    @endif
                            </ul>
                        </div>
                        <div class="single__widget price__filter widget__bg">
                            <h2 class="widget__title position__relative h3">{{ translate('Price range')}}</h2>
                            
                                <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                                    <div class="price__filter--group">
                                        <label class="price__filter--label" for="Filter-Price-GTE1">From</label>
                                        <div class="price__filter--input border-radius-5 d-flex align-items-center">
                                            <span class="price__filter--currency">$</span>
                                            <input class="price__filter--input__field border-0" id="Filter-Price-GTE1" name="min_price" type="number" placeholder="0" value="{{ isset($min_price) ? $min_price : '0'  }}" min="{{ isset($min_price) ? $min_price : $products->min('unit_price')  }}" max="{{ isset($max_price) ? $max_price : $products->max('unit_price')  }}">
                                        </div>
                                    </div>
                                    <div class="price__divider">
                                        <span>-</span>
                                    </div>
                                    <div class="price__filter--group">
                                        <label class="price__filter--label" for="Filter-Price-LTE1">To</label>
                                        <div class="price__filter--input border-radius-5 d-flex align-items-center">
                                            <span class="price__filter--currency">$</span>
                                            <input class="price__filter--input__field border-0" id="Filter-Price-LTE1" name="max_price" type="number"  placeholder="250.00" value="{{ isset($max_price) ? $max_price : '0'  }}" min="{{ isset($min_price) ? $min_price : $products->min('unit_price')  }}" max="{{ isset($max_price) ? $max_price : $products->max('unit_price')  }}"> 
                                        </div>	
                                    </div>
                                </div>
                                <button class="price__filter--btn primary__btn" type="submit">Filter</button>
                            
                        </div>

                        <!-- Attributes -->
                        @foreach ($attributes as $attribute)
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title position__relative h3">{{ $attribute->getTranslation('name') }}</h2>
                            <ul class="widget__form--check">

                                @foreach ($attribute->attribute_values as $attribute_value)
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label" for="collapse_{{ str_replace(' ', '_', $attribute->name) }}">{{ $attribute_value->value }}</label>
                                    <input class="widget__form--check__input" id="collapse_{{ str_replace(' ', '_', $attribute->name) }}" type="checkbox" name="selected_attribute_values[]"
                                           value="{{ $attribute_value->value }}" @if (in_array($attribute_value->value, $selected_attribute_values)) checked @endif
                                           onchange="filter()"
                                           />
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                 @endforeach

                            </ul>
                        </div>
                        @endforeach

                        <!-- Color -->
                        @if (get_setting('color_filter_activation'))
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title position__relative h3">{{ translate('Filter by color')}}</h2>
                            <ul class="widget__form--check">
                                    @foreach ($colors as $key => $color)
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label" for="color{{ $key }}">{{ $color->code }}</label>
                                    <input
                                        class="widget__form--check__input"
                                        id="color{{ $key }}"
                                        type="radio"
                                        name="color"
                                        value="{{ $color->code }}"
                                        onchange="filter()"
                                                        @if(isset($selected_color) && $selected_color == $color->code) checked @endif
                                        >
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="shop__header bg__gray--color d-flex align-items-center justify-content-between mb-30">
                        <button class="widget__filter--btn d-none d-md-flex align-items-center">
                            <svg  class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"/><circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/><circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/><circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/></svg> 
                            <span class="widget__filter--btn__text">Filter</span>
                        </button>
                        <div class="product__view--mode d-flex align-items-center">
                            <div class="product__view--mode__list product__short--by align-items-center d-none d-lg-flex">
                                <label class="product__view--label">Sort By :</label>
                                <div class="select shop__header--select">
                                    <select class="product__view--select" name="sort_by" onchange="filter()">
                                        <option value="">{{ translate('Sort by')}}</option>
                                        <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>{{ translate('Newest')}}</option>
                                        <option value="oldest" @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>{{ translate('Oldest')}}</option>
                                        <option value="price-asc" @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset>{{ translate('Price low to high')}}</option>
                                        <option value="price-desc" @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>{{ translate('Price high to low')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="product__view--mode__list">
                                <div class="product__grid--column__buttons d-flex justify-content-center">
                                    <button class="product__grid--column__buttons--icons active" data-toggle="tab" aria-label="product grid btn" data-target="#product_grid">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 9 9">
                                        <g  transform="translate(-1360 -479)">
                                        <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4" height="4" transform="translate(1360 479)" fill="currentColor"/>
                                        <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4" height="4" transform="translate(1360 484)" fill="currentColor"/>
                                        <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4" height="4" transform="translate(1365 479)" fill="currentColor"/>
                                        <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4" height="4" transform="translate(1365 484)" fill="currentColor"/>
                                        </g>
                                        </svg>
                                    </button>
                                    <button class="product__grid--column__buttons--icons" data-toggle="tab" aria-label="product list btn" data-target="#product_list">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 13 8">
                                        <g id="Group_14700" data-name="Group 14700" transform="translate(-1376 -478)">
                                        <g  transform="translate(12 -2)">
                                        <g id="Group_1326" data-name="Group 1326">
                                        <rect id="Rectangle_5729" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor"/>
                                        <rect id="Rectangle_5730" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor"/>
                                        </g>
                                        <g id="Group_1328" data-name="Group 1328" transform="translate(0 -3)">
                                        <rect id="Rectangle_5729-2" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor"/>
                                        <rect id="Rectangle_5730-2" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor"/>
                                        </g>
                                        <g id="Group_1327" data-name="Group 1327" transform="translate(0 -1)">
                                        <rect id="Rectangle_5731" data-name="Rectangle 5731" width="3" height="2" transform="translate(1364 487)" fill="currentColor"/>
                                        <rect id="Rectangle_5732" data-name="Rectangle 5732" width="9" height="2" transform="translate(1368 487)" fill="currentColor"/>
                                        </g>
                                        </g>
                                        </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--<p class="product__showing--count">Showing 1–9 of 21 results</p>-->
                    </div>
                    <div class="shop__product--wrapper">
                        <input type="hidden" name="keyword" value="{{ $query }}">
                        <div class="tab_content">
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner product__grid--inner">
                                    <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 mb--n30">
                                            @foreach ($products as $key => $product)
                                                    <div class="col mb-30">
                                                        @include('frontend.partials.product_box_1',['product' => $product])
                                                    </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="product_list" class="tab_pane">
                                <div class="product__section--inner">
                                    <div class="row row-cols-1 mb--n30">
                                        @foreach ($products as $key => $product)
                                                <div class="col mb-30">
                                                    @include('frontend.partials.product_box_2',['product' => $product])
                                                </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination__area bg__gray--color">
                            <nav class="pagination">
                                {{ $products->appends(request()->input())->links() }}
                                <!--                                <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
                                                                    <li class="pagination__list"><a href="shop.html" class="pagination__item--arrow  link ">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"/></svg></a>
                                                                    <li>
                                                                    <li class="pagination__list"><span class="pagination__item pagination__item--current">1</span></li>
                                                                    <li class="pagination__list"><a href="shop.html" class="pagination__item link">2</a></li>
                                                                    <li class="pagination__list"><a href="shop.html" class="pagination__item link">3</a></li>
                                                                    <li class="pagination__list"><a href="shop.html" class="pagination__item link">4</a></li>
                                                                    <li class="pagination__list"><a href="shop.html" class="pagination__item--arrow  link ">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/></svg></a>
                                                                    <li>
                                                                </ul>-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </form>
    </section>
    <!-- End shop section -->

    
</main>

@endsection

@section('script')
<script type="text/javascript">
    function filter(){
        $('#search-form').submit();
    }
    function rangefilter(arg){
        $('input[name=min_price]').val(arg[0]);
        $('input[name=max_price]').val(arg[1]);
        filter();
    }
</script>
@endsection
