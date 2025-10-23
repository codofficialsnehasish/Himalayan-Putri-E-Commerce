@extends('layouts.web-app')

@section('title') Shop @endsection

@section('content')

<!-- Page item Area -->
<div id="page_item_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h3>Shop</h3>
            </div>		
            <div class="col-sm-6 text-right">
                <ul class="p_items">
                    <li><a href="{{ route('home') }}">home</a></li>
                    <li><a href="javascript:void(0)">category</a></li>
                    <li><span>Shop</span></li>
                </ul>					
            </div>	
        </div>
    </div>
</div>


<!-- Shop Product Area -->
<div class="shop_page_area">
    <div class="container">
        <div class="shop_bar_tp fix">
            <form method="GET" id="filterForm">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 short_by_area">
                        <div class="short_by_inner">
                            <label>Sort by:</label>
                            <select class="sort-select" name="sort_by" onchange="document.getElementById('filterForm').submit()">
                                <option value="" selected disabled>Choose...</option>
                                <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name Descending</option>
                                <option value="date_desc" {{ request('sort_by') == 'date_desc' ? 'selected' : '' }}>Date Descending</option>
                                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price Assending</option>
                                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price Descending</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="col-sm-6 col-xs-12 show_area">
                        <div class="show_inner">
                            <label>Show:</label>
                            <select class="show-select" name="show" onchange="document.getElementById('filterForm').submit()">
                                <option value="4" {{ request('show') == '4' ? 'selected' : '' }}>4</option>
                                <option value="8" {{ request('show') == '8' ? 'selected' : '' }}>8</option>
                                <option value="12" {{ request('show') == '12' ? 'selected' : '' }}>12</option>
                                <option value="30" {{ request('show') == '30' ? 'selected' : '' }}>30</option>
                                <option value="{{ $products->total() }}" {{ request('show') == $products->total() ? 'selected' : '' }}>ALL</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
            
        <div class="shop_details text-center">
            <div class="row">    
                @foreach($products as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="single_product">
                        <div class="product_image">
                            <img src="{{ getProductMainImage($product->id) }}" alt=""/>
                            <div class="box-content">
                                <a href="javascript:void(0)" class="add-to-wishlist" data-product-id="{{ $product->id }}"><i class="fa fa-heart-o"></i></a>
                                {{-- <a href="javascript:void(0)" class="add-to-cart-btn" data-product-id="{{ $product->id }}"><i class="fa fa-cart-plus"></i></a> --}}
                                <a href="{{ route('product.details',$product->slug) }}"><i class="fa fa-search"></i></a>
                            </div>                                        
                        </div>
        
                        <div class="product_btm_text">
                            <h4><a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a></h4>
                            <span class="price">Rs {{ $product->total_price }}</span>
                        </div>
                    </div>                                
                </div> 
                @endforeach
            </div>
        </div>
        
        <div class="col-xs-12">
            <div class="blog_pagination pgntn_mrgntp fix">
                <div class="pagination text-center">
                    @if ($products->hasPages())
                        <ul>
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            @else
                                <li><a href="{{ $products->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                            @endif
        
                            {{-- Pagination Elements --}}
                            @foreach ($products->links()->elements as $element)
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        <li>
                                            <a href="{{ $url }}" class="{{ ($page == $products->currentPage()) ? 'active' : '' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            @endforeach
        
                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                            @else
                                <li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection