@extends('layouts.web-app')
@section('style')

@endsection
@section('title')
    Product Details
@endsection

@section('content')

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ asset('assets/site-assets/imgs/bg/breadcrumb-bg-grocery.jpg') }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Product Details</h2>
                        <div class="breadcrumb__menu">
                            <nav>
                                <ul>
                                    <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                    <li><span><a href="{{ route('product.all') }}">Product</a></span></li>
                                    <li><span>{{ $product->name }}</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->
    

    <!-- Product details area start -->
    <div class="product__details-area section-space-medium">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-xxl-6 col-lg-6">
                <div class="product__details-thumb-wrapper d-sm-flex align-items-start mr-50">

                    {{-- Thumbnail Tabs --}}
                    <div class="product__details-thumb-tab mr-20">
                        <nav>
                            <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                @php 
                                    $product_images = $product->getMedia('products-media');
                                @endphp

                                @foreach($product_images as $index => $image)
                                    <button 
                                        class="nav-link {{ $index == 0 ? 'active' : '' }}" 
                                        id="img-{{ $index }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#img-{{ $index }}"
                                        type="button" 
                                        role="tab"
                                        aria-controls="img-{{ $index }}"
                                        aria-selected="{{ $index == 0 ? 'true' : 'false' }}"
                                    >
                                        <img 
                                            src="{{ $image->getUrl() }}" 
                                            alt="{{ $product->name }}"
                                            data-gc-caption="Your caption text"
                                            data-variation-id="{{ $image->custom_properties['variation_id'] ?? '' }}"
                                            data-option-id="{{ $image->custom_properties['option_id'] ?? '' }}"
                                            data-variation-name="{{ $image->custom_properties['variation_name'] ?? '' }}"
                                            data-option-value="{{ $image->custom_properties['option_value'] ?? '' }}"
                                        >
                                    </button>
                                @endforeach
                            </div>
                        </nav>
                    </div>

                    {{-- Main Image Area --}}
                    <div class="product__details-thumb-tab-content">
                        <div class="tab-content" id="productthumbcontent">
                            @foreach($product_images as $index => $image)
                                <div 
                                    class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" 
                                    id="img-{{ $index }}" 
                                    role="tabpanel" 
                                    aria-labelledby="img-{{ $index }}-tab"
                                >
                                    <div class="product__details-thumb-big w-img">
                                        <img 
                                            src="{{ $image->getUrl() }}" 
                                            alt="{{ $product->name }}"
                                            data-gc-caption="Your caption text"
                                            data-variation-id="{{ $image->custom_properties['variation_id'] ?? '' }}"
                                            data-option-id="{{ $image->custom_properties['option_id'] ?? '' }}"
                                            data-variation-name="{{ $image->custom_properties['variation_name'] ?? '' }}"
                                            data-option-value="{{ $image->custom_properties['option_value'] ?? '' }}"
                                        >
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                {{-- @include('site.products._preview') --}}
            </div>

            <div class="col-xxl-6 col-lg-6">
                <div class="product__details-content pr-80">
                    {{-- <div class="product__details-top d-sm-flex align-items-center mb-15">
                    <div class="product__details-tag mr-10">
                        <a href="#">Construction</a>
                    </div>
                    <div class="product__details-rating mr-10">
                        <a href="#"><i class="fa-solid fa-star"></i></a>
                        <a href="#"><i class="fa-solid fa-star"></i></a>
                        <a href="#"><i class="fa-regular fa-star"></i></a>
                    </div>
                    <div class="product__details-review-count">
                        <a href="#">10 Reviews</a>
                    </div>
                    </div> --}}
                    <h3 class="product__details-title">{{ $product->name }}</h3>
                    <div class="product__details-price">
                        <span class="new-price" id="dynamic-price">
                            @if($product->product_type === 'simple')
                                ₹ {{ number_format($product->total_price, 2) }}
                            @elseif($product->product_type === 'attribute')
                                @php
                                    // Get the first variation option price
                                    $firstOption = $product->variations
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
                    </div>
                    <p>{!! $product->sort_description !!}</p>

                    <div class="product__details-action mb-35">
                        <div class="product_veriation">
                            @if ($product->product_type == 'attribute')
                                @foreach ($product->variations as $variation)
                                    <div class="pd_clr">
                                        <h4>{{ $variation->name }}:</h4>
                                        <div class="d-flex">
                                        @foreach ($variation->options as $option)
                                            @if ($option->variation_type == 'color')
                                                <a href="#" class="color-option variation-option"
                                                    data-option-id="{{ $option->id }}" 
                                                    data-price="{{ $option->price }}"
                                                    data-variation-id="{{ $variation->id }}"
                                                    data-variation-name="{{ $variation->name }}"
                                                    data-option-value="{{ $option->value }}"
                                                    data-image-url="{{ $product->media->firstWhere('custom_properties.option_id', $option->id)?->getUrl() }}"
                                                    style="background: {{ $option->value }};">
                                                </a>
                                            @elseif($option->variation_type == 'image')
                                                <a href="#" class="image-option variation-option"
                                                    data-option-id="{{ $option->id }}"
                                                    data-price="{{ $option->price }}"
                                                    data-variation-id="{{ $variation->id }}"
                                                    data-variation-name="{{ $variation->name }}"
                                                    data-option-value="{{ $option->value }}"
                                                    data-image-url="{{ $product->media->firstWhere('custom_properties.option_id', $option->id)?->getUrl() }}">
                                                    <img src="{{ asset('storage/' . $option->value) }}"
                                                        alt="{{ $option->value }}" width="30" height="30">
                                                </a>
                                            @else
                                                <a href="#" class="text-option variation-option"
                                                    data-option-id="{{ $option->id }}"
                                                    data-price="{{ $option->price }}"
                                                    data-variation-id="{{ $variation->id }}"
                                                    data-variation-name="{{ $variation->name }}"
                                                    data-option-value="{{ $option->value }}"
                                                    data-image-url="{{ $product->media->firstWhere('custom_properties.option_id', $option->id)?->getUrl() }}">
                                                    {{ $option->value }}
                                                </a>
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="product__quantity">
                            <div class="product-quantity-wrapper">
                                {{-- <form action="#"> --}}
                                    <button class="cart-minus"><i class="fa-light fa-minus"></i></button>
                                    <input class="cart-input cart-plus-minus-box" type="text" value="1" name="qttybutton" 
                                        id="quantity_6041ce9eca5d6">
                                    <button class="cart-plus"><i class="fa-light fa-plus"></i></button>
                                {{-- </form> --}}
                            </div>
                        </div>
                        <div class="product__add-cart">
                            <a href="javascript:void(0);" class="fill-btn cart-btn add-to-cart-btn" data-product-id="{{ $product->id }}"
                                data-product-type="{{ $product->product_type }}">
                                <span class="fill-btn-inner">
                                    <span class="fill-btn-normal">Add To Cart<i
                                        class="fa-solid fa-basket-shopping"></i></span>
                                    <span class="fill-btn-hover">Add To Cart<i
                                        class="fa-solid fa-basket-shopping"></i></span>
                                </span>
                            </a>
                        </div>
                        <div class="product__add-wish">
                            <a href="javascript:void(0);" class="product__add-wish-btn add-to-wishlist"
                                data-product-id="{{ $product->id }}" data-product-type="{{ $product->product_type }}"><i class="fa-solid fa-heart"></i></a>
                        </div>
                    </div>
                    {{-- <div class="product__details-meta mb-20">
                    <div class="sku">
                        <span>SKU:</span>
                        <a href="#">BO1D0MX8SJ</a>
                    </div>
                    <div class="categories">
                        <span>Categories:</span> <a href="#">Milk,</a> <a href="#">Cream,</a> <a
                            href="#">Fermented.</a>
                    </div>
                    <div class="tag">
                        <span>Tags:</span> <a href="#"> Cheese,</a> <a href="#">Custard,</a> <a href="#">Frozen</a>
                    </div>
                    </div>
                    <div class="product__details-share">
                    <span>Share:</span>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-behance"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="product__details-additional-info section-space-medium-top">
            <div class="row">
                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="product__details-more-tab mr-15">
                    <nav>
                        <div class="nav nav-tabs flex-column " id="productmoretab" role="tablist">
                            <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-description" type="button" role="tab"
                                aria-controls="nav-description" aria-selected="true">Description</button>
                            <button class="nav-link" id="nav-additional-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-additional" type="button" role="tab"
                                aria-controls="nav-additional" aria-selected="false">Additional Information </button>
                            <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review"
                                aria-selected="false">Reviews</button>
                        </div>
                    </nav>
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="product__details-more-tab-content">
                    <div class="tab-content" id="productmorecontent">
                        <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                            aria-labelledby="nav-description-tab">
                            <div class="product__details-des">
                                {!! $product->long_description !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-additional" role="tabpanel"
                            aria-labelledby="nav-additional-tab">
                            <div class="product__details-info">
                                <ul>
                                    @foreach($product->specifications as $spec)
                                    <li class="check-list__item">
                                        <i class="fa fa-arrow-circle-right"></i>
                                        <span class="custom-attribute-name">{{ $spec->title }}</span>
                                        :
                                        <span class="custom-attribute-value">{{ $spec->description }}</span> 
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                            <div class="product__details-review">
                                <div class="pda_rtng_area fix">
                                    @php
                                        $approvedReviews = $product->reviews()->where('is_approved', false);
                                        $reviewCount = $approvedReviews->count();
                                        $averageRating = $reviewCount > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
                                    @endphp

                                    <h4>{{ $averageRating }} <span>(Overall)</span></h4>
                                    <span>
                                        @if($reviewCount > 0)
                                            Based on {{ $reviewCount }} {{ Str::plural('Comment', $reviewCount) }}
                                        @else
                                            No reviews yet
                                        @endif
                                    </span>
                                </div>

                                @if($reviewCount > 0)
                                    <div class="rtng_cmnt_area fix">
                                        @foreach($approvedReviews->latest()->get() as $review)
                                            <div class="single_rtng_cmnt">
                                                <div class="rtngs">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                    <span>({{ $review->rating }})</span>
                                                </div>
                                                <div class="rtng_author">
                                                    <h3>{{ $review->user->name ?? 'Anonymous' }}</h3>
                                                    <span>{{ $review->created_at->format('H:i') }}</span>
                                                    <span>{{ $review->created_at->format('j F Y') }}</span>
                                                </div>
                                                <p>{{ $review->comment }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @auth
                                <div class="col-md-6 rcf_pdnglft">
                                    <div class="rtng_cmnt_form_area fix">
                                        <h3>Add your Comments</h3>
                                        <div class="rtng_form">
                                            <form action="{{ route('reviews.store', $product) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="star-rating animated-stars">
                                                    <input type="radio" id="star5" name="rating" value="5">
                                                    <label for="star5" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="star4" name="rating" value="4">
                                                    <label for="star4" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="star3" name="rating" value="3">
                                                    <label for="star3" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="star2" name="rating" value="2">
                                                    <label for="star2" class="fa-solid fa-star"></label>
                                                    <input type="radio" id="star1" name="rating" value="1">
                                                    <label for="star1" class="fa-solid fa-star"></label>
                                                </div>
                                                {{-- <div class="input-area">
                                                    <input type="text" name="title" placeholder="Summarize your review" required>
                                                </div> --}}
                                                <div class="input-area">
                                                    <textarea name="comment" placeholder="What did you like or dislike? What should other customers know?" required></textarea>
                                                </div>
                                                {{-- <div class="input-area">
                                                    <label>Upload Photos (Optional)</label>
                                                    <div class="image-upload-container">
                                                        <input type="file" id="review-images" name="images[]" multiple accept="image/*">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="recommend-product" name="recommend" value="1">
                                                    <label class="form-check-label" for="recommend-product">I recommend this product</label>
                                                </div>
                                                <input class="btn border-btn" type="submit" value="Add Review" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <div class="alert alert-info">
                                        Please <a href="{{ route('login') }}">login</a> to leave a review.
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Product details area end -->


    <!-- =================Product Area Starts================= -->
    @if ($relatedProducts->isNotEmpty())
    <section class="discount-area p-relative section-space">
        <div class="container">
            <div class="section-title-wrapper-4 mb-40">
                <span class="section-subtitle-4 for-grocery mb-10">our products</span>
                <h2 class="section-title-4">Related Products</h2>
            </div>
            <div class="discount-main p-relative">
                <div class="discount-slider-navigation grocery__navigation">
                    <button type="button" class="discount-slider-button-prev">
                        <i class="fa-regular fa-angle-left"></i>
                    </button>
                    <button type="button" class="discount-slider-button-next">
                        <i class="fa-regular fa-angle-right"></i>
                    </button>
                </div>
                <div class="row align-items-center">
                    <div class="col-xxl-12">
                        <div class="swiper furuniture-active">
                            <div class="swiper-wrapper">
                                @foreach ($relatedProducts as $relatedProduct)
                                @php
                                    // Get first variation id if product has attributes
                                    $variation_id = null;
                                    $firstOption = $relatedProduct->variations
                                        ->flatMap->options
                                        ->first();
                                    if ($firstOption) {
                                        $variation_id = $firstOption->id;
                                    }
                                @endphp
                                <div class="swiper-slide">
                                    <div class="product-item grocery__product">
                                        <div class="product-thumb theme-bg-2">
                                            <a href="{{ route('product.details', $relatedProduct->slug) }}">
                                                <img src="{{ getProductMainImage($relatedProduct->id) }}" alt="{{ $relatedProduct->name }}">
                                            </a>
                                            <div class="product-action-item">
                                                <button type="button"
                                                    class="product-action-btn add-to-cart-btn"
                                                    data-product-id="{{ $relatedProduct->id }}"
                                                    data-variation-id="{{ $variation_id }}"
                                                    data-product-type="{{ $relatedProduct->product_type }}">
                                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <span class="product-tooltip">Add to Cart</span>
                                                </button>
                                                <button type="button"
                                                    class="product-action-btn add-to-wishlist"
                                                    data-product-id="{{ $relatedProduct->id }}">
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
                                            <h4 class="product-title">
                                                <a href="{{ route('product.details', $relatedProduct->slug) }}">
                                                    {{ $relatedProduct->name }}
                                                </a>
                                            </h4>
                                            <div class="product-price">
                                                <span class="product-new-price">
                                                    @if($relatedProduct->product_type === 'simple')
                                                        ₹ {{ number_format($relatedProduct->total_price, 2) }}
                                                    @elseif($relatedProduct->product_type === 'attribute')
                                                        @php
                                                            $firstOption = $relatedProduct->variations->flatMap->options->first();
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
                            </div> <!-- swiper-wrapper -->
                        </div> <!-- swiper -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    <!-- =================Product Area Ends================= -->

@endsection