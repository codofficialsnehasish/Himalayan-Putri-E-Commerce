@extends('layouts.web-app')

@php
    use App\Models\Page;
    $page = Page::where('slug', 'wishlist')->first(); 
@endphp
@section('title')
    {{ $page->meta_title ?? $page->name ?? 'Wishlist' }}
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

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ get_setting('breadcrumb_banner', true) }}"></div>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper text-center">
                    <h2 class="breadcrumb__title">Wishlist</h2>
                    <div class="breadcrumb__menu">
                    <nav>
                        <ul>
                            <li><span><a href="{{ route('home') }}">Home</a></span></li>
                            <li><span>wishlist</span></li>
                        </ul>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <div class="cart-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlists as $wishlist)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{ route('product.details', $wishlist->product?->slug) }}">
                                            <img src="{{ getProductMainImage($wishlist->product?->id) }}" alt="img">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{ route('product.details', $wishlist->product?->slug) }}">
                                            {{ $wishlist->product?->name }} 
                                            @if($wishlist->productVariationOption)
                                                - {{ $wishlist->productVariationOption->variation_name }}
                                            @endif
                                        </a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">
                                            @if($wishlist->productVariationOption)
                                                <span>₹ {{ $wishlist->productVariationOption->price }}</span>
                                            @else
                                                <span>₹ {{ $wishlist->product?->total_price }}</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="product-remove">
                                        <a href="{{ route('wishlist.delete',$wishlist->id) }}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection