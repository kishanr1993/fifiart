@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    @php
        $availability = "out of stock";
        $qty = 0;
        if($detailedProduct->variant_product) {
            foreach ($detailedProduct->stocks as $key => $stock) {
                $qty += $stock->qty;
            }
        }
        else {
            $qty = optional($detailedProduct->stocks->first())->qty;
        }
        if($qty > 0){
            $availability = "in stock";
        }
    @endphp
    <!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
<meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
<meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
<meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
<meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
<meta property="og:type" content="og:product" />
<meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
<meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
<meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
<meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
<meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
<meta property="product:brand" content="{{ $detailedProduct->brand ? $detailedProduct->brand->name : env('APP_NAME') }}">
<meta property="product:availability" content="{{ $availability }}">
<meta property="product:condition" content="new">
<meta property="product:price:amount" content="{{ number_format($detailedProduct->unit_price, 2) }}">
<meta property="product:retailer_item_id" content="{{ $detailedProduct->slug }}">
<meta property="product:price:currency"
      content="{{ get_system_default_currency()->code }}" />
<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')

<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content">
                        <h1 class="breadcrumb__content--title text-white mb-10">Product Details</h1>
                        <ul class="breadcrumb__content--menu d-flex">
                            <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Product Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start product details section -->
    <section class="product__details--section section--padding">
        <div class="container">
            <div class="row row-cols-lg-2 row-cols-md-2">
                <div class="col">
                     @include('frontend.product_details.image_gallery')
                </div>   
                <div class="col">
                    @include('frontend.product_details.details')
                </div>
            </div>
        </div>
    </section>
    <!-- End product details section -->

    <!-- Start product details tab section -->
    <section class="product__details--tab__section section--padding">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <ul class="product__details--tab d-flex mb-30">
                        <li class="product__details--tab__list active" data-toggle="tab" data-target="#description">Description</li>
                        <li class="product__details--tab__list" data-toggle="tab" data-target="#reviews">Product Reviews</li>

                        @if ($detailedProduct->video_link != null)
                        <li class="product__details--tab__list" data-toggle="tab" data-target="#information">{{ translate('Video') }}</li>
                        @endif

                        @if ($detailedProduct->pdf != null)
                        <li class="product__details--tab__list" data-toggle="tab" data-target="#custom">{{ translate('Downloads') }}</li>
                        @endif
                    </ul>
                    <div class="product__details--tab__inner border-radius-10">
                        <div class="tab_content">
                            <div id="description" class="tab_pane active show">
                                <!--<div class="product__tab--content">-->
                                     <?php echo $detailedProduct->getTranslation('description'); ?>
                                <!--</div>--> 
                            </div>
                            <div id="reviews" class="tab_pane">
                                @include('frontend.product_details.review_section')
                                <!--                                <div class="product__reviews">
                                                                    <div class="product__reviews--header">
                                                                        <h3 class="product__reviews--header__title mb-20">Customer Reviews</h3>
                                                                        <div class="reviews__ratting d-flex align-items-center">
                                                                            <ul class="rating d-flex">
                                                                                <li class="rating__list">
                                                                                    <span class="rating__list--icon">
                                                                                        <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </li>
                                                                                <li class="rating__list">
                                                                                    <span class="rating__list--icon">
                                                                                        <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </li>
                                                                                <li class="rating__list">
                                                                                    <span class="rating__list--icon">
                                                                                        <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </li>
                                                                                <li class="rating__list">
                                                                                    <span class="rating__list--icon">
                                                                                        <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </li>
                                                                                <li class="rating__list">
                                                                                    <span class="rating__list--icon">
                                                                                        <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                        <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                        </svg>
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                            <span class="reviews__summary--caption">Based on 2 reviews</span>
                                                                        </div>
                                                                        <a class="actions__newreviews--btn primary__btn" href="#writereview">Write A Review</a>
                                                                    </div>
                                                                    <div class="reviews__comment--area">
                                                                        <div class="reviews__comment--list d-flex">
                                                                            <div class="reviews__comment--thumbnail">
                                                                                <img src="assets/img/other/comment-thumb1.webp" alt="comment-thumbnail">
                                                                            </div>
                                                                            <div class="reviews__comment--content">
                                                                                <h4 class="reviews__comment--content__title">Richard Smith</h4>
                                                                                <ul class="rating reviews__comment--rating d-flex mb-5">
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                </ul>
                                                                                <p class="reviews__comment--content__desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos ex repellat officiis neque. Veniam, rem nesciunt. Assumenda distinctio, autem error repellat eveniet ratione dolor facilis accusantium amet pariatur, non eius!</p>
                                                                                <span class="reviews__comment--content__date">January 11, 2022</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reviews__comment--list margin__left d-flex">
                                                                            <div class="reviews__comment--thumbnail">
                                                                                <img src="assets/img/other/comment-thumb2.webp" alt="comment-thumbnail">
                                                                            </div>
                                                                            <div class="reviews__comment--content">
                                                                                <h4 class="reviews__comment--content__title">Laura Johnson</h4>
                                                                                <ul class="rating reviews__comment--rating d-flex mb-5">
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                </ul>
                                                                                <p class="reviews__comment--content__desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos ex repellat officiis neque. Veniam, rem nesciunt. Assumenda distinctio, autem error repellat eveniet ratione dolor facilis accusantium amet pariatur, non eius!</p>
                                                                                <span class="reviews__comment--content__date">January 11, 2022</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reviews__comment--list d-flex">
                                                                            <div class="reviews__comment--thumbnail">
                                                                                <img src="assets/img/other/comment-thumb3.webp" alt="comment-thumbnail">
                                                                            </div>
                                                                            <div class="reviews__comment--content">
                                                                                <h4 class="reviews__comment--content__title">Richard Smith</h4>
                                                                                <ul class="rating reviews__comment--rating d-flex mb-5">
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                </ul>
                                                                                <p class="reviews__comment--content__desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos ex repellat officiis neque. Veniam, rem nesciunt. Assumenda distinctio, autem error repellat eveniet ratione dolor facilis accusantium amet pariatur, non eius!</p>
                                                                                <span class="reviews__comment--content__date">January 11, 2022</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="writereview" class="reviews__comment--reply__area">
                                                                        <form action="#">
                                                                            <h3 class="reviews__comment--reply__title mb-15">Add a review </h3>
                                                                            <div class="reviews__ratting d-flex align-items-center mb-20">
                                                                                <ul class="rating d-flex">
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="rating__list">
                                                                                        <span class="rating__list--icon">
                                                                                            <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg" width="13.105" height="13.732" viewBox="0 0 10.105 9.732">
                                                                                            <path data-name="star - Copy" d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z" transform="translate(0 -0.018)" fill="currentColor"></path>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 mb-10">
                                                                                    <textarea class="reviews__comment--reply__textarea" placeholder="Your Comments...." ></textarea>
                                                                                </div> 
                                                                                <div class="col-lg-6 col-md-6 mb-15">
                                                                                    <label>
                                                                                        <input class="reviews__comment--reply__input" placeholder="Your Name...." type="text">
                                                                                    </label>
                                                                                </div>  
                                                                                <div class="col-lg-6 col-md-6 mb-15">
                                                                                    <label>
                                                                                        <input class="reviews__comment--reply__input" placeholder="Your Email...." type="email">
                                                                                    </label>
                                                                                </div>  
                                                                            </div>
                                                                            <button class="text-white primary__btn" data-hover="Submit" type="submit">SUBMIT</button>
                                                                        </form>   
                                                                    </div> 
                                                                </div>    -->
                            </div>

                             @if ($detailedProduct->video_link != null)
                            <div id="information" class="tab_pane">
                                @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/{{ get_url_params($detailedProduct->video_link, 'v') }}"></iframe>
                    @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                <iframe class="embed-responsive-item"
                                        src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                    @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                <iframe
                                    src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}"
                                    width="500" height="281" frameborder="0" webkitallowfullscreen
                                    mozallowfullscreen allowfullscreen></iframe>
                    @endif 
                            </div>
                            @endif

                        @if ($detailedProduct->pdf != null)
                            <div id="custom" class="tab_pane">
                                <a href="{{ uploaded_asset($detailedProduct->pdf) }}" class="btn btn-primary">{{ translate('Download') }}</a>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product details tab section -->

    <!-- Related products -->
    @include('frontend.product_details.related_products')
    
</main>

@endsection

@section('modal')
<!-- Image Modal -->
<div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-4">
                <div class="size-300px size-lg-450px">
                    <img class="img-fit h-100 lazyload"
                         src="{{ static_asset('assets/img/placeholder.jpg') }}"
                         data-src=""
                         onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('conversations.store') }}" method="POST"
                  enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="form-group">
                        <input type="text" class="form-control mb-3 rounded-0" name="title"
                               value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}"
                               required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control rounded-0" rows="8" name="message" required
                                  placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary fw-600 rounded-0"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary fw-600 rounded-0 w-100px">{{ translate('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bid Modal -->
    @if($detailedProduct->auction_product == 1)
        @php 
            $highest_bid = $detailedProduct->bids->max('amount');
            $min_bid_amount = $highest_bid != null ? $highest_bid+1 : $detailedProduct->starting_bid; 
        @endphp
<div class="modal fade" id="bid_for_detail_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Bid For Product') }} <small>({{ translate('Min Bid Amount: ').$min_bid_amount }})</small> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('auction_product_bids.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="form-group">
                        <label class="form-label">
                                    {{translate('Place Bid Price')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="number" step="0.01" class="form-control form-control-sm" name="amount" min="{{ $min_bid_amount }}" placeholder="{{ translate('Enter Amount') }}" required>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    @endif

<!-- Product Review Modal -->
<div class="modal fade" id="product-review-modal">
    <div class="modal-dialog">
        <div class="modal-content" id="product-review-modal-content">

        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        getVariantPrice();
    });

    function CopyToClipboard(e) {
        var url = $(e).data('url');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(url).select();
        try {
            document.execCommand("copy");
            AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
        } catch (err) {
            AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
        }
        $temp.remove();
        // if (document.selection) {
        //     var range = document.body.createTextRange();
        //     range.moveToElementText(document.getElementById(containerid));
        //     range.select().createTextRange();
        //     document.execCommand("Copy");

        // } else if (window.getSelection) {
        //     var range = document.createRange();
        //     document.getElementById(containerid).style.display = "block";
        //     range.selectNode(document.getElementById(containerid));
        //     window.getSelection().addRange(range);
        //     document.execCommand("Copy");
        //     document.getElementById(containerid).style.display = "none";

        // }
        // AIZ.plugins.notify('success', 'Copied');
    }

    function show_chat_modal() {
        @if (Auth::check())
            $('#chat_modal').modal('show');
        @else
            $('#login_modal').modal('show');
        @endif
    }

    // Pagination using ajax
    $(window).on('hashchange', function() {
        if(window.history.pushState) {
            window.history.pushState('', '/', window.location.pathname);
        } else {
            window.location.hash = '';
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.product-queries-pagination .pagination a', function(e) {
            getPaginateData($(this).attr('href').split('page=')[1], 'query', 'queries-area');
            e.preventDefault();
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.product-reviews-pagination .pagination a', function(e) {
            getPaginateData($(this).attr('href').split('page=')[1], 'review', 'reviews-area');
            e.preventDefault();
        });
    });

    function getPaginateData(page, type, section) {
        $.ajax({
            url: '?page=' + page,
            dataType: 'json',
            data: {type: type},
        }).done(function(data) {
            $('.'+section).html(data);
            location.hash = page;
        }).fail(function() {
            alert('Something went worng! Data could not be loaded.');
        });
    }
    // Pagination end

    function showImage(photo) {
        $('#image_modal img').attr('src', photo);
        $('#image_modal img').attr('data-src', photo);
        $('#image_modal').modal('show');
    }

    function bid_modal(){
        @if (isCustomer() || isSeller())
            $('#bid_for_detail_product').modal('show');
            @elseif (isAdmin())
            AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers & Sellers can Bid.") }}');
        @else
            $('#login_modal').modal('show');
        @endif
    }

    function product_review(product_id) {
        @if (isCustomer())
            @if ($review_status == 1)
                $.post('{{ route('product_review_modal') }}', {
                    _token: '{{ @csrf_token() }}',
                    product_id: product_id
                }, function(data) {
                    $('#product-review-modal-content').html(data);
                    $('#product-review-modal').modal('show', {
                        backdrop: 'static'
                    });
                    AIZ.extra.inputRating();
                });
            @else
                AIZ.plugins.notify('warning', '{{ translate("Sorry, You need to buy this product to give review.") }}');
            @endif
        @elseif (Auth::check() && !isCustomer())
            AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers can give review.") }}');
        @else
            $('#login_modal').modal('show');
        @endif
    }
</script>
@endsection
