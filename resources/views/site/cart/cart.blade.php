@extends('layouts.web-app')

@section('title') Cart @endsection

@section('content')
    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ asset('assets/site-assets/imgs/bg/breadcrumb-bg.jpg') }}"></div>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper text-center">
                    <h2 class="breadcrumb__title">Cart</h2>
                    <div class="breadcrumb__menu">
                    <nav>
                        <ul>
                            <li><span><a href="{{ route('home') }}">Home</a></span></li>
                            <li><span>Cart</span></li>
                        </ul>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <!-- Cart area start  -->
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
                                <th class="product-price">Unit Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart_item)
                            <tr data-id="{{ $cart_item->id }}">
                                <td class="product-thumbnail"><a href="{{ route('product.details', $cart_item->product?->slug) }}"><img
                                        src="{{ getProductMainImage($cart_item->product?->id) }}" alt="img"></a></td>
                                <td class="product-name">
                                    <a href="{{ route('product.details', $cart_item->product?->slug) }}">
                                        {{ $cart_item->product?->name }}
                                        @if($cart_item->productVariationOption)
                                            - {{ $cart_item->productVariationOption->variation_name }}
                                        @endif
                                    </a>
                                </td>
                                <td class="product-price">
                                    <span class="amount">
                                        @if($cart_item->productVariationOption)
                                            <span>₹ {{ $cart_item->productVariationOption->price }}</span>
                                        @else
                                            <span>₹ {{ $cart_item->product?->total_price }}</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="product-quantity text-center">
                                    <div class="product-quantity mt-10 mb-10">
                                    <div class="product-quantity-form">
                                        <form action="#">
                                            <button class="cart-minus"><i class="far fa-minus"></i></button>
                                            <input class="cart-input qty" type="text" value="{{ $cart_item->quantity }}">
                                            <button class="cart-plus"><i class="far fa-plus"></i></button>
                                        </form>
                                    </div>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="amount">
                                        @if($cart_item->productVariationOption)
                                            <span class="cpp_total">₹ {{ $cart_item->productVariationOption->price * $cart_item->quantity }}</span>
                                        @else
                                            <span class="cpp_total">₹ {{ $cart_item->product?->total_price * $cart_item->quantity }}</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="product-remove"><a href="javascript:void(0);" class="cp_remove"><i class="fa fa-times"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="coupon-all">
                        <div class="coupon d-flex align-items-center">
                            <form id="applyCouponForm">
                                @csrf
                                <input id="coupon_code" class="input-text" name="coupon_code" placeholder="Coupon code" type="text">
                                <button class="fill-btn" type="submit">
                                    <span class="fill-btn-inner">
                                    <span class="fill-btn-normal">apply coupon</span>
                                    <span class="fill-btn-hover">apply coupon</span>
                                    </span>
                                </button>
                            </form>
                            <p id="coupon-message"></p>
                        </div>
                        <div class="coupon2">
                            <button onclick="window.location.reload()" class="fill-btn" type="submit">
                                <span class="fill-btn-inner">
                                <span class="fill-btn-normal">Update cart</span>
                                <span class="fill-btn-hover">Update cart</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 ml-auto">
                    <div class="cart-page-total">
                        <h2>Cart totals</h2>
                        <ul class="mb-20">
                            <li>Subtotal <span id="cart-subtotal">₹{{ calculate_cart_total() }}</span></li>
                            <li>Total <span id="cart-grandtotal">₹{{ calculate_cart_total() }}</span></li>
                        </ul>
                        <a class="fill-btn" href="{{ route('checkout') }}">
                            <span class="fill-btn-inner">
                                <span class="fill-btn-normal">Proceed to checkout</span>
                                <span class="fill-btn-hover">Proceed to checkout</span>
                            </span>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Cart area end  -->

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#applyCouponForm").submit(function (e) {
            e.preventDefault();
            let couponCode = $("#coupon_code").val();

            $.ajax({
                url: "{{ route('cart.apply.coupon') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    coupon_code: couponCode
                },
                success: function (response) {
                    if (response.success) {
                        showToast('success', 'Success', response.message);
                        $("#cart-grandtotal").text("Rs " + response.new_total);
                    } else {
                        showToast('error', 'Error', response.message);
                    }
                }
            });
        });
    });

</script>
@endsection