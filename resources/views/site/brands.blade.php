@extends('layouts.web-app')

@php
    use App\Models\Page;
    $page = Page::where('slug', 'brand')->orWhere('slug','brands')->first(); 
@endphp
@section('title')
    {{ $page->meta_title ?? $page->name ?? 'Brands' }}
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
                    <h2 class="breadcrumb__title">Brands</h2>
                    <div class="breadcrumb__menu">
                    <nav>
                        <ul>
                            <li><span><a href="{{ route('home') }}">Home</a></span></li>
                            <li><span>Brands</span></li>
                        </ul>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area start  -->


<!-- Product area start -->
<section class="bd-product__area section-space">
    <div class="container">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                <div class="bd-product__result mb-30">
                    <h4>{{ $brands->count() }} Item On List</h4>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-6">
                <form method="GET" id="filterForm">
                <div class="product__filter-wrapper d-flex flex-wrap gap-3 align-items-center justify-content-md-end mb-30">
                    {{-- <div class="bd-product__filter-btn">
                        <button type="button"><i class="fa-solid fa-list"></i> Filter</button>
                    </div> --}}
                    <div class="product__filter-count d-flex align-items-center">
                        <div class="btn-dropdown__options mx-3">
                            <select class="sort-select" name="sort_by" onchange="document.getElementById('filterForm').submit()">
                                <option value="" selected disabled>Choose...</option>
                                <option value="name_desc"
                                    {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name Descending
                                </option>
                                <option value="date_desc"
                                    {{ request('sort_by') == 'date_desc' ? 'selected' : '' }}>Date Descending
                                </option>
                                <option value="price_asc"
                                    {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price Assending
                                </option>
                                <option value="price_desc"
                                    {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price Descending
                                </option>
                            </select>
                        </div>
                        <div class="btn-dropdown__options">
                            <select class="show-select" name="show"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="4" {{ request('show') == '4' ? 'selected' : '' }}>4</option>
                                <option value="8" {{ request('show') == '8' ? 'selected' : '' }}>8</option>
                                <option value="12" {{ request('show') == '12' ? 'selected' : '' }}>12
                                </option>
                                <option value="30" {{ request('show') == '30' ? 'selected' : '' }}>30
                                </option>
                                <option value="50" {{ request('show') == '50' ? 'selected' : '' }}>50
                                </option>
                                <option value="{{ $brands->total() }}"
                                    {{ request('show') == $brands->total() ? 'selected' : '' }}>ALL</option>
                            </select>
                        </div>
                        {{-- <div class="bd-product__filter-style nav nav-tabs" role="tablist">
                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-grid" type="button" role="tab" aria-selected="false"><i
                                    class="fa-solid fa-grid"></i></button>
                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list"
                                type="button" role="tab" aria-selected="true"><i class="fa-solid fa-bars"></i></button>
                        </div> --}}
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="product__filter-tab">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-grid" role="tabpanel"
                            aria-labelledby="nav-grid-tab">
                            <div class="row g-5">
                                @foreach($brands as $brand)
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="product-item">
                                        <div class="product-badge">
                                            {{-- <span class="product-trending">10% off</span> --}}
                                        </div>
                                        <div class="product-thumb">
                                            <a href="{{ route('brands.products', $brand->slug) }}"><img src="{{ $brand->getFirstMediaUrl('brand') }}" alt=""></a>
                                        </div>
                                        <div class="product-content">
                                            {{-- <div class="product-tag">
                                                <span>ACCESSORIES</span>
                                            </div> --}}
                                            <h4 class="product-title">
                                                <a href="{{ route('brands.products', $brand->slug) }}">{{ $brand->name }}</a>
                                            </h4>
                                            <p>{!! $brand->description !!}</p>
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
        @if ($brands->hasPages())
            <div class="row">
                <div class="bd-basic__pagination mt-50 d-flex align-items-center justify-content-center">
                    <nav>
                        <ul>
                            {{-- Previous Page Link --}}
                            @if ($brands->onFirstPage())
                                <li class="disabled">
                                    <a href="#" tabindex="-1" aria-disabled="true">
                                        <i class="fa-regular fa-angle-left"></i>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $brands->previousPageUrl() }}">
                                        <i class="fa-regular fa-angle-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($brands->links()->elements as $element)
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $brands->currentPage())
                                            <li><span class="current">{{ $page }}</span></li>
                                        @else
                                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($brands->hasMorePages())
                                <li>
                                    <a href="{{ $brands->nextPageUrl() }}">
                                        <i class="fa-regular fa-angle-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="disabled">
                                    <a href="#" tabindex="-1" aria-disabled="true">
                                        <i class="fa-regular fa-angle-right"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @endif

    </div>
</section>
<!-- Product area end -->
@endsection