@extends('layouts.web-app')

@section('title')
    {{ $page->meta_title ?? $page->name ?? 'Home' }}
@endsection

@section('meta')
    @if(!empty($page->meta_description))
        <meta name="description" content="{{ $page->meta_description }}">
    @endif

    @if(!empty($page->meta_keywords))
        <meta name="keywords" content="{{ $page->meta_keywords }}">
    @endif
@endsection

@section('content')

    <!-- Banner area start -->
    @if ($sliders->isNotEmpty())
    <section class="banner-4 p-relative grocery-banner-area fix bg-image"
        data-background="{{ asset('assets/site-assets/imgs/grocery/banner/bg.png') }}" data-bg-color="#F8FBF0;">
        <div class="swiper banner-active-grocery">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="banner-item-4 d-flex align-items-center">
                    <div class="container">
                    <div class="row g-5 align-self-center">
                        <div class="col-xxl-6 col-lg-6">
                            <div class="banner-content-4 grocery__content">
                                <span>{{ $slider->heading }}</span>
                                <h2 class="banner-title-4">{{ $slider->title }}</h2>
                                <div class="banner-btn-wrapper grocery__btn-group mt-50">
                                <a class="solid-btn" href="{{ route('product.all') }}">Buy Now<span><i
                                            class="fa-regular fa-angle-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-6">
                            <div class="banner-thumb-wrapper-4 p-relative">
                                <div class="banner-thumb-4">
                                    <img src="{{ $slider->getFirstMediaUrl('slider') }}" alt="image">
                                </div>
                                <div class="banner-discout-tag">
                                    <img src="{{ $slider->getFirstMediaUrl('slider-discount-image') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="banner-dot-inner">
            <div class="banner-dot"></div>
        </div>
        </div>
    </section>
    @endif
    <!-- Banner area end -->

    <!-- Gorocery category area start -->
    @if($categorys->isNotEmpty())
    <section class="grocery-category pt-100">
        <div class="container">
            <div class="discount-main p-relative">
                <div class="discount-slider-navigation grocery__navigation">
                    <button type="button" class="discount-slider-button-prev"><i class="fa-regular fa-angle-left"></i>
                    </button>
                    <button type="button" class="discount-slider-button-next"><i
                        class="fa-regular fa-angle-right"></i></button>
                </div>
                <div class="row align-items-center">
                    <div class="col-xxl-12">
                        <div class="swiper f-category-active">
                            <div class="swiper-wrapper">
                                @foreach($categorys as $category)
                                <div class="swiper-slide">
                                    <div class="grocery-category__item">
                                        <div class="icon">
                                            <a href="{{ route('categories.products',$category->slug) }}">
                                            <img src="{{ $category->getFirstMediaUrl('category') }}" alt="icon">
                                            </a>
                                        </div>
                                        <h6>
                                            <a href="{{ route('categories.products',$category->slug) }}">{{ $category->name }}</a>
                                        </h6>
                                        {{-- <span>16 items</span> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Gorocery category area end -->

    <!-- Trendy collection area start -->
    <section class="grocery-trendy pt-100 pb-100">
        <div class="container">
            <div class="grocery-trendy__header">
                <div class="section-title-wrapper-4 mb-40">
                    <span class="section-subtitle-4 for-grocery mb-10">THIS MONTH</span>
                    <h2 class="section-title-4">Trendy Products</h2>
                </div>
                <div class="bd-product__filter-style grocery-trendy__tab nav nav-tabs" role="tablist">
                    <button class="nav-link active" id="collection-tab" data-bs-toggle="tab" data-bs-target="#collection"
                        type="button" role="tab" aria-selected="false">All Products</button>
                    <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button"
                        role="tab" aria-selected="true">New In</button>
                    {{-- <button class="nav-link" id="top-tab" data-bs-toggle="tab" data-bs-target="#top" type="button"
                        role="tab" aria-selected="true">Top Rated</button>
                    <button class="nav-link" id="tensing-tab" data-bs-toggle="tab" data-bs-target="#tensing" type="button"
                        role="tab" aria-selected="true">Tensing Products</button> --}}
                </div>
            </div>
            <div class="product__filter-tab">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="collection" role="tabpanel" aria-labelledby="collection-tab">
                        <div class="row g-4">
                            @foreach ($all_products as $all_product)
                                @php
                                    // Get the first variation option price
                                    $veriation_id = null;
                                    $veriation_name = null;
                                    $firstOption = $all_product->variations
                                        ->flatMap->options // merge all options into one collection
                                        ->first();
                                    if($firstOption){
                                        $veriation_id = $firstOption->id;
                                        $veriation_name = $firstOption->variation_name;
                                    }
                                @endphp
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-badge">
                                        {{-- <span class="product-trending">10% off</span> --}}
                                    </div>
                                    <div class="product-thumb theme-bg-2">
                                        <a href="{{ route('product.details', $all_product->slug) }}"><img src="{{ getProductMainImage($all_product->id) }}"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn add-to-cart-btn" data-product-id="{{ $all_product->id }}" data-variation-id="{{ $veriation_id }}" data-product-type="{{ $all_product->product_type }}">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        {{-- <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button> --}}
                                        <button type="button" class="product-action-btn add-to-wishlist" data-product-id="{{ $all_product->id }}">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="{{ route('product.details', $all_product->slug) }}">{{ $all_product->name }} @if($veriation_name) - {{ $veriation_name }} @endif</a></h4>
                                        {{-- <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div> --}}
                                        <div class="product-price">
                                            <span class="product-new-price">
                                                @if($all_product->product_type === 'simple')
                                                    ₹ {{ number_format($all_product->total_price, 2) }}
                                                @elseif($all_product->product_type === 'attribute')
                                                    @php
                                                        // Get the first variation option price
                                                        $firstOption = $all_product->variations
                                                            ->flatMap->options // merge all options into one collection
                                                            ->first();
                                                    @endphp

                                                    @if($firstOption)
                                                        ₹ {{ number_format($firstOption->price, 2) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                        <div class="row g-4">
                            @foreach ($new_products as $new_products)
                                @php
                                    // Get the first variation option price
                                    $veriation_id = null;
                                    $veriation_name = null;
                                    $firstOption = $new_products->variations
                                        ->flatMap->options // merge all options into one collection
                                        ->first();
                                    if($firstOption){
                                        $veriation_id = $firstOption->id;
                                        $veriation_name = $firstOption->variation_name;
                                    }
                                @endphp
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-badge">
                                        {{-- <span class="product-trending">10% off</span> --}}
                                    </div>
                                    <div class="product-thumb theme-bg-2">
                                        <a href="{{ route('product.details', $new_products->slug) }}"><img src="{{ getProductMainImage($new_products->id) }}"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn add-to-cart-btn" data-product-id="{{ $new_products->id }}" data-variation-id="{{ $veriation_id }}" data-product-type="{{ $new_products->product_type }}">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        {{-- <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button> --}}
                                        <button type="button" class="product-action-btn add-to-wishlist" data-product-id="{{ $new_products->id }}">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="{{ route('product.details', $new_products->slug) }}">{{ $new_products->name }} @if($veriation_name) - {{ $veriation_name }} @endif</a></h4>
                                        {{-- <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div> --}}
                                        <div class="product-price">
                                            <span class="product-new-price">
                                                @if($new_products->product_type === 'simple')
                                                    ₹ {{ number_format($new_products->total_price, 2) }}
                                                @elseif($new_products->product_type === 'attribute')
                                                    @php
                                                        // Get the first variation option price
                                                        $firstOption = $new_products->variations
                                                            ->flatMap->options // merge all options into one collection
                                                            ->first();
                                                    @endphp

                                                    @if($firstOption)
                                                        ₹ {{ number_format($firstOption->price, 2) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="top" role="tabpanel" aria-labelledby="top-tab">
                        <div class="row g-4">
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product4.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Broccoli Farms</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 129.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product6.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Organic Avocado</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 150.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-badge">
                                        <span class="product-trending">NEW</span>
                                    </div>
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product7.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Fresh Orange</a>
                                        </h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 80.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product8.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Read apple</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 49.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product6.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Organic Avocado</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 150.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-badge">
                                        <span class="product-trending">NEW</span>
                                    </div>
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product7.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Fresh Orange</a>
                                        </h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 80.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product8.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Read apple</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 49.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tensing" role="tabpanel" aria-labelledby="tensing-tab">
                        <div class="row g-4">
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-badge">
                                        <span class="product-trending">15% off</span>
                                    </div>
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product3.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Broccoli Organic</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 300.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product4.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Broccoli Farms</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 129.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product6.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Organic Avocado</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 150.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-badge">
                                        <span class="product-trending">NEW</span>
                                    </div>
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product7.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Fresh Orange</a>
                                        </h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 80.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="product-item grocery__product">
                                    <div class="product-thumb theme-bg-2">
                                        <a href="grocery-details.html"><img src="assets/imgs/grocery/product/product8.png"
                                            alt=""></a>
                                        <div class="product-action-item">
                                        <button type="button" class="product-action-btn">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <span class="product-tooltip">Add to Cart</span>
                                        </button>
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#producQuickViewModal">

                                            <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Quick View</span>
                                        </button>
                                        <button type="button" class="product-action-btn">

                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                            </svg>
                                            <span class="product-tooltip">Add To Wishlist</span>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4 class="product-title"><a href="grocery-details.html">Read apple</a></h4>
                                        <div class="user-rating mb-1">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                        <span class="product-new-price">USD 49.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Trendy collection end end -->

    

    <!-- Off area start -->
    <section class="grocery-off">
        <div class="container">
            <div class="row g-4">
                @foreach ($offer_banners as $offer_banner)
                <div class="col-lg-6">
                    <a href="{{ route('product.all') }}" class="grocery-off__item h-100 bg-image d-block"
                        data-background="{{ $offer_banner->getFirstMediaUrl('offer-banner') }}">
                        <span class="fo-discount">{{ $offer_banner->heading }}</span>
                        <h3 class="text-capitalize">{{ $offer_banner->title }}</h3>
                        <div class="solid-btn mt-30">Buy Now<span><i class="fa-regular fa-angle-right"></i></span></div>
                    </a>
                </div>
                @endforeach
                {{-- <div class="col-lg-7">
                    <a href="{{ route('product.all') }}" class="grocery-off__item h-100 bg-image d-block"
                        data-background="{{ asset('assets/site-assets/imgs/grocery/product/off-02.png') }}">
                        <span class="fo-discount">Limited Offer</span>
                        <h3 class="text-capitalize text-white">Don't miss 25% off <br> on all fruits</h3>
                        <div class="solid-btn mt-30">Buy Now<span><i class="fa-regular fa-angle-right"></i></span></div>
                    </a>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Off area end -->

    <!-- Best sell area start -->
    <section class="grocery-seller pt-100 pb-100">
        <div class="container">
            <div class="section-title-wrapper-4 mb-40">
                <span class="section-subtitle-4 for-grocery mb-10">THIS Week</span>
                <h2 class="section-title-4">Best Sellers</h2>
            </div>
            <div class="row g-4">
                @foreach($best_selling_products as $best_product)
                @php
                    // Get the first variation option price
                    $veriation_id = null;
                    $firstOption = $best_product->variations
                        ->flatMap->options // merge all options into one collection
                        ->first();
                    if($firstOption){
                        $veriation_id = $firstOption->id;
                    }
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="grocery-seller__item">
                        <div class="fs-image">
                            <img src="{{ getProductMainImage($best_product->id) }}" alt="">
                        </div>
                        <div class="fs-content">
                        <h5><a href="{{ route('product.details', $best_product->slug) }}" class="text-capitalize">{{ $best_product->name }}</a></h5>
                        <span>
                            @if($best_product->product_type === 'simple')
                                ₹ {{ number_format($best_product->total_price, 2) }}
                            @elseif($best_product->product_type === 'attribute')
                                @php
                                    // Get the first variation option price
                                    $firstOption = $best_product->variations
                                        ->flatMap->options // merge all options into one collection
                                        ->first();
                                @endphp

                                @if($firstOption)
                                    ₹ {{ number_format($firstOption->price, 2) }}
                                @else
                                    <span class="product-new-price">N/A</span>
                                @endif
                            @endif
                        </span>
                        {{-- <div class="fs-rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Best sell area end -->
    

    <!-- Top sale area start -->
    @if ($featured_products->isNotEmpty())
    <section class="discount-area p-relative section-space">
        <div class="container">
            <div class="section-title-wrapper-4 mb-40">
                <span class="section-subtitle-4 for-grocery mb-10">top sale</span>
                <h2 class="section-title-4">Featured Product</h2>
            </div>
            <div class="discount-main p-relative">
                <div class="discount-slider-navigation grocery__navigation">
                    <button type="button" class="discount-slider-button-prev"><i class="fa-regular fa-angle-left"></i>
                    </button>
                    <button type="button" class="discount-slider-button-next"><i
                        class="fa-regular fa-angle-right"></i></button>
                </div>
                <div class="row align-items-center">
                    <div class="col-xxl-12">
                        <div class="swiper furuniture-active">
                            <div class="swiper-wrapper">
                                @foreach ($featured_products as $featured_product)
                                @php
                                    // Get the first variation option price
                                    $veriation_id = null;
                                    $veriation_name = null;
                                    $firstOption = $featured_product->variations
                                        ->flatMap->options // merge all options into one collection
                                        ->first();
                                    if($firstOption){
                                        $veriation_id = $firstOption->id;
                                        $veriation_name = $firstOption->variation_name;
                                    }
                                @endphp
                                <div class="swiper-slide">
                                    <div class="product-item grocery__product">
                                        <div class="product-badge">
                                            {{-- <span class="product-trending">10% off</span> --}}
                                        </div>
                                        <div class="product-thumb theme-bg-2">
                                        <a href="{{ route('product.details', $featured_product->slug) }}"><img src="{{ getProductMainImage($featured_product->id) }}"
                                                alt=""></a>
                                        <div class="product-action-item">
                                            <button type="button" class="product-action-btn add-to-cart-btn" data-product-id="{{ $featured_product->id }}" data-variation-id="{{ $veriation_id }}" data-product-type="{{ $featured_product->product_type }}">
                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                </svg>
                                                <span class="product-tooltip">Add to Cart</span>
                                            </button>
                                            {{-- <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                                data-bs-target="#producQuickViewModal">

                                                <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                    d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                    fill="white" />
                                                </svg>
                                                <span class="product-tooltip">Quick View</span>
                                            </button> --}}
                                            <button type="button" class="product-action-btn add-to-wishlist" data-product-id="{{ $featured_product->id }}">

                                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                    d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                    fill="white" />
                                                </svg>
                                                <span class="product-tooltip">Add To Wishlist</span>
                                            </button>
                                        </div>
                                        </div>
                                        <div class="product-content">
                                        <h4 class="product-title"><a href="{{ route('product.details', $featured_product->slug) }}">{{ $featured_product->name }} @if($veriation_name) - {{ $veriation_name }} @endif</a></h4>
                                        {{-- <div class="user-rating">
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </div> --}}
                                        <div class="product-price">
                                            <span class="product-new-price">
                                                @if($featured_product->product_type === 'simple')
                                                    ₹ {{ number_format($featured_product->total_price, 2) }}
                                                @elseif($featured_product->product_type === 'attribute')
                                                    @php
                                                        // Get the first variation option price
                                                        $firstOption = $featured_product->variations
                                                            ->flatMap->options // merge all options into one collection
                                                            ->first();
                                                    @endphp

                                                    @if($firstOption)
                                                        ₹ {{ number_format($firstOption->price, 2) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Top sale area end -->

    <!-- Testiminial area start -->
    @if ($testimonials->isNotEmpty())
    <section class="grocery-testimonial section-space theme-bg-2">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-40">
                <div class="section-title-wrapper-4">
                    <span class="section-subtitle-4 for-grocery mb-10">Testimonials</span>
                    <h2 class="section-title-4">Client Feedback</h2>
                </div>
                <div class="navigation__wrapprer">
                    <div class="common-slider-navigation">
                        <button class="testimonial-button-prev"><i class="fa-regular fa-arrow-left"></i></button>
                        <button class="testimonial-button-next"><i class="fa-regular fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="swiper testimonial-active-3">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="grocery-testimonial__item">
                        <div class="ft-head">
                            <div class="ft-info">
                                <div class="fs-rating">
                                    @for ($i = 1; $i <= $testimonial->rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($j = $testimonial->rating; $j < 5; $j++)
                                        <i class="fal fa-star"></i>
                                    @endfor
                                </div>
                                <h5>{{ $testimonial->name }}</h5>
                                <span>{{ $testimonial->address }}</span>
                            </div>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_340_404)">
                                    <path
                                    d="M23.9729 39.9999C23.9729 37.3838 23.9729 34.7678 23.9729 32.0674C27.1379 32.1518 29.7642 30.886 31.717 27.7636C32.7945 26.0758 33.5352 23.713 33.5352 21.8564C29.8989 21.8564 26.1952 21.8564 22.4915 21.8564C22.4915 14.5146 22.4915 7.25726 22.4915 -0.00012207C28.2827 -0.00012207 34.0739 -0.00012207 39.9325 -0.00012207C39.9325 0.253042 39.9325 0.421819 39.9325 0.674983C39.9325 7.34165 39.9325 14.0083 39.9325 20.5906C39.9325 29.9577 35.084 37.5526 27.8113 39.5779C26.5992 39.9999 25.3197 40.0843 23.9729 39.9999ZM35.084 19.9999C35.084 20.0843 35.1514 20.1687 35.1514 20.1687C35.4207 26.6665 31.7844 32.4893 26.6665 33.7551C26.2625 33.8395 25.7238 33.8395 25.5218 34.0927C25.3197 34.4303 25.4544 35.1054 25.4544 35.6117C25.4544 36.4556 25.4544 37.2995 25.4544 38.2277C26.3972 37.9746 27.2726 37.8902 28.148 37.637C34.276 35.6117 38.451 28.8606 38.451 20.8438C38.451 14.6834 38.451 8.60747 38.451 2.44714C38.451 2.27836 38.451 2.10958 38.451 1.94081C33.6026 1.94081 28.8214 1.94081 24.0403 1.94081C24.0403 8.01676 24.0403 14.0083 24.0403 19.9999C27.744 19.9999 31.3803 19.9999 35.084 19.9999Z"
                                    fill="#80B501" />
                                    <path
                                    d="M1.4141 39.9999C1.4141 37.3839 1.4141 34.7679 1.4141 32.0674C4.4444 32.1518 7.00332 30.9704 8.95619 28.0168C10.1683 26.2447 10.909 23.8818 10.9764 21.7721C7.34002 21.7721 3.63632 21.7721 -0.0673828 21.7721C-4.2744e-05 14.5147 -4.2744e-05 7.25732 -4.2744e-05 -6.10352e-05C5.7912 -6.10352e-05 11.5824 -6.10352e-05 17.3737 -6.10352e-05C17.3737 0.168715 17.3737 0.337492 17.3737 0.506268C17.3737 7.25732 17.3737 14.0928 17.3737 20.8438C17.3064 29.7046 12.6599 37.2151 5.7912 39.4092C4.37706 39.9155 2.96292 40.0843 1.4141 39.9999ZM15.9596 1.85648C11.1111 1.85648 6.32992 1.85648 1.54878 1.85648C1.54878 7.93243 1.54878 13.924 1.54878 19.9999C5.25248 19.9999 8.95619 19.9999 12.5926 19.9999C12.9293 27.0042 8.75417 33.4177 2.96292 34.0084C2.96292 35.3586 2.96292 36.7932 2.96292 38.2278C3.83834 37.9746 4.71376 37.8902 5.58918 37.5527C11.7171 35.6117 15.8922 28.7763 15.9596 20.7594C15.9596 14.5991 15.9596 8.52314 15.9596 2.36281C15.9596 2.27842 15.9596 2.10964 15.9596 1.85648Z"
                                    fill="#80B501" />
                                </g>
                                <defs>
                                    <clipPath>
                                    <rect width="40" height="40" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </div>
                        <p>{!! $testimonial->message !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Testiminial area end -->

    <!-- Service area start -->
    @if ($services->isNotEmpty())
    <section class="grocery-service pt-100 pb-100">
        <div class="container">
            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="grocery-service__item">
                        <div class="fsr-icon">
                            <img src="{{ $service->getFirstMediaUrl('service-icon') }}" alt="Service Icon" width="80" height="63" style="object-fit: contain;">
                        </div>
                        <div class="frs-content">
                        <h6>{{ $service->title }}</h6>
                        <p>{!! $service->description !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- Service area end -->

@endsection
