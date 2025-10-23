@extends('layouts.web-app')

@section('title')
    Product Details
@endsection

@section('content')

    <!-- Page item Area -->
    <div id="page_item_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h3>Shop Details</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ul class="p_items">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="#">products</a></li>
                        <li><span>{{ $product->name }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Area  -->
    <div class="prdct_dtls_page_area">
        <div class="container">
            <div class="row">
                <!-- Product Details Image -->
                {{-- <div class="col-md-6 col-xs-12">
                <div class="pd_img fix">
                    <a class="venobox" href="{{ getProductMainImage($product->id) }}"><img src="{{ getProductMainImage($product->id) }}" alt=""/></a>
                </div>
            </div> --}}
                <div class="col-md-6 col-xs-12">
                    <div class="pd_img fix">
                        @include('site.products._preview')
                    </div>
                </div>
                <!-- Product Details Content -->
                <div class="col-md-6 col-xs-12">
                    <div class="prdct_dtls_content">
                        <a class="pd_title" href="#">{{ $product->name }}</a>
                        <div class="pd_price_dtls fix">
                            <!-- Product Price -->
                            <div class="pd_price">
                                <span class="new" id="dynamic-price">Rs {{ $product->total_price }}</span>
                                {{-- <span class="new">Rs <span id="dynamic-price"> {{ $product->total_price }}</span></span> --}}
                                <span class="old">({{ $product->price }})</span>
                            </div>
                            <!-- Product Ratting -->
                            <div class="pd_ratng">
                                <div class="rtngs">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pd_text">
                            <h4>overview:</h4>
                            {!! $product->sort_description !!}
                        </div>
                        <div class="pd_clr_qntty_dtls fix">
                            {{-- <div class="pd_clr">
                            <h4>color:</h4>
                            <a href="#" class="active" style="background: #ffac9a;">color 1</a>
                            <a href="#" style="background: #ddd;">color 2</a>
                            <a href="#" style="background: #000000;">color 3</a>
                        </div> --}}
                            @if ($product->product_type == 'attribute')
                                @foreach ($product->variations as $variation)
                                    <div class="pd_clr">
                                        <h4>{{ $variation->name }}:</h4>
                                        @foreach ($variation->options as $option)
                                            @if ($option->variation_type == 'color')
                                                <a href="#" class="color-option variation-option"
                                                    data-option-id="{{ $option->id }}" data-price="{{ $option->price }}"
                                                    style="background: {{ $option->value }};">
                                                    {{ $option->value }}
                                                </a>
                                            @elseif($option->variation_type == 'image')
                                                <a href="#" class="image-option variation-option"
                                                    data-option-id="{{ $option->id }}"
                                                    data-price="{{ $option->price }}">
                                                    <img src="{{ asset('uploads/variations/' . $option->value) }}"
                                                        alt="{{ $option->value }}" width="30" height="30">
                                                </a>
                                            @else
                                                <a href="#" class="text-option variation-option"
                                                    data-option-id="{{ $option->id }}"
                                                    data-price="{{ $option->price }}">
                                                    {{ $option->value }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @endif
                            <input type="hidden" id="selected-variation-id" value="">

                            <div class="pd_qntty_area">
                                <h4>quantity:</h4>
                                <div class="pd_qty fix">
                                    <input value="1" name="qttybutton" class="cart-plus-minus-box"
                                        id="quantity_6041ce9eca5d6" type="number">
                                </div>
                            </div>
                        </div>
                        <!-- Product Action -->
                        <div class="pd_btn fix">
                            <a class="btn btn-default acc_btn add-to-cart-btn" data-product-id="{{ $product->id }}"
                                data-product-type="{{ $product->product_type }}">add to bag</a>
                            <a class="btn btn-default acc_btn btn_icn add-to-wishlist"
                                data-product-id="{{ $product->id }}" data-product-type="{{ $product->product_type }}"><i
                                    class="fa fa-heart"></i></a>
                            {{-- <a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a> --}}
                        </div>
                        <div class="pd_share_area fix">
                            <h4>share this on:</h4>
                            <div class="pd_social_icon">
                                <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                <a class="vimeo" href="#"><i class="fa fa-vimeo"></i></a>
                                <a class="google_plus" href="#"><i class="fa fa-google-plus"></i></a>
                                <a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                                <a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="position: relative;top: 85px;">
                <div class="col-xs-12">
                    <div class="pd_tab_area fix">
                        <ul class="pd_tab_btn nav nav-tabs" role="tablist">
                            <li>
                                <a class="active" href="#description" role="tab" data-toggle="tab">Description</a>
                            </li>
                            <li>
                                <a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="description">
                                {!! $product->long_description !!}
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="reviews">
                                <div class="pda_rtng_area fix">
                                    <h4>4.5 <span>(Overall)</span></h4>
                                    <span>Based on 9 Comments</span>
                                </div>
                                <div class="rtng_cmnt_area fix">
                                    <div class="single_rtng_cmnt">
                                        <div class="rtngs">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>(4)</span>
                                        </div>
                                        <div class="rtng_author">
                                            <h3>John Doe</h3>
                                            <span>11:20</span>
                                            <span>6 January 2017</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost
                                            rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem
                                            ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Utenim ad minim veniam, quis nost.
                                        </p>
                                    </div>

                                </div>
                                <div class="col-md-6 rcf_pdnglft">
                                    <div class="rtng_cmnt_form_area fix">
                                        <h3>Add your Comments</h3>
                                        <div class="rtng_form">
                                            <form action="#">
                                                <div class="input-area"><input type="text"
                                                        placeholder="Type your name" /></div>
                                                <div class="input-area"><input type="text"
                                                        placeholder="Type your email address" /></div>
                                                <div class="input-area">
                                                    <textarea name="message" placeholder="Write a review"></textarea>
                                                </div>
                                                <input class="btn border-btn" type="submit" value="Add Review" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Related Product Area -->
    <div class="related_prdct_area text-center">
        <div class="container">
            <!-- Section Title -->
            <div class="rp_title text-center">
                <h3>Related products</h3>
            </div>

            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single_product">
                            <div class="product_image">
                                <a href="{{ route('product.details', $relatedProduct->slug) }}">
                                    <img src="{{ getProductMainImage($relatedProduct->id) }}" alt="" />
                                </a>
                                <div class="box-content">
                                    <a href="javascript:void(0)" class="add-to-wishlist"
                                        data-product-id="{{ $relatedProduct->id }}"><i class="fa fa-heart-o"></i></a>
                                    {{-- <a href="javascript:void(0)" class="add-to-cart-btn" data-product-id="{{ $relatedProduct->id }}"><i class="fa fa-cart-plus"></i></a> --}}
                                    <a href="{{ route('product.details', $relatedProduct->slug) }}"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>

                            <div class="product_btm_text">
                                <h4><a
                                        href="{{ route('product.details', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                </h4>
                                <span class="price">Rs {{ $relatedProduct->total_price }}</span>
                            </div>
                        </div>
                    </div> <!-- End Col -->
                @endforeach
            </div>
        </div>
    </div>

@endsection
