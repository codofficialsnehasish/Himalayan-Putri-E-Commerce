@extends('layouts.web-app')

@php
    use App\Models\Page;
    $page = Page::where('slug', 'checkout')->first(); 
@endphp
@section('title')
    {{ $page->meta_title ?? $page->name ?? 'Checkout' }}
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
                     <h2 class="breadcrumb__title">Checkout</h2>
                     <div class="breadcrumb__menu">
                        <nav>
                           <ul>
                              <li><span><a href="{{ route('home') }}">Home</a></span></li>
                              <li><span>checkout</span></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Breadcrumb area start  -->

    <!-- =================Checkout Area Starts================= -->
    <section class="checkout-area section-space">
        <div class="container">
            <form id="checkoutForm" class="checkout_form">
                @csrf
                <div class="row">
                    <!-- Left side: Billing details -->
                    <div class="col-lg-6">
                        <div class="checkbox-form">
                            <h3 class="mb-15">Billing Details</h3>
                            <div class="row g-4">
                                {{-- ===== Existing addresses ===== --}}
                                @if($address->isNotEmpty())
                                    <div class="col-md-12">
                                        <label class="fw-bold">Select Saved Address</label>
                                        @foreach($address as $addr)
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="addrradio"
                                                    value="{{ $addr->id }}" {{ $addr->is_default==1 ? 'checked' : '' }} required>
                                                <label class="form-check-label">
                                                    <strong>{{ $addr->billing_first_name }}</strong> ({{ $addr->billing_phone_number }}) <br>
                                                    {{ get_address_by_id($addr->id) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- ===== Add new address option ===== --}}
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="radio" name="addrradio" class="form-check-input"
                                            value="fornewaddr" @if($address->isEmpty()) checked @endif required>
                                        <label class="form-check-label fw-bold">Add New Address</label>
                                    </div>
                                </div>

                                {{-- ===== New address form ===== --}}
                                <div id="address-data-fild" class="col-md-12 mt-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>First Name <span class="required">*</span></label>
                                            <input name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input name="email" value="{{ old('email') }}" type="email" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Phone <span class="required">*</span></label>
                                            <input name="phone" value="{{ old('phone') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Country <span class="required">*</span></label>
                                            <select id="country_id" name="country" class="form-control" required>
                                                <option value="">Choose...</option>
                                                @foreach($countrys as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>State <span class="required">*</span></label>
                                            <select id="states_id" name="state" class="form-control" required>
                                                <option value="">Select Country</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>City <span class="required">*</span></label>
                                            <select id="citys_id" name="city" class="form-control" required>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Address <span class="required">*</span></label>
                                            <textarea name="address" rows="2" class="form-control">{{ old('address') }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input name="pincode" value="{{ old('pincode') }}" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Order Notes</label>
                                            <textarea name="order_note" rows="3" class="form-control">{{ old('order_note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right side: Your Order -->
                    <div class="col-lg-6">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart_items as $item)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $item->product?->name }}
                                                    @if($item->productVariationOption)
                                                        ({{ $item->productVariationOption->variation_name }})
                                                    @endif
                                                    <strong class="product-quantity"> × {{ $item->quantity }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="amount">
                                                        ₹ {{ number_format(($item->productVariationOption ? $item->productVariationOption->price : $item->product?->total_price) * $item->quantity, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        @if (session()->has('applied_coupon'))
                                            <tr>
                                                <th>Coupon ({{ session('applied_coupon.code') }})</th>
                                                <td>- ₹ {{ number_format(session('applied_coupon.discount'), 2) }}</td>
                                            </tr>
                                        @endif
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td>
                                                <strong>
                                                    ₹ {{ number_format($cart_items->sum(function($item) {
                                                        return ($item->productVariationOption ? $item->productVariationOption->price : $item->product?->total_price) * $item->quantity;
                                                    }) - (session('applied_coupon.discount') ?? 0), 2) }}
                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            {{-- Payment Methods --}}
                            <div class="payment-method mt-30">
                                <div class="accordion" id="checkoutAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="codMethod">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#codCollapse" aria-expanded="true" aria-controls="codCollapse">
                                                Cash on Delivery (COD)
                                            </button>
                                        </h2>
                                        <div id="codCollapse" class="accordion-collapse collapse show"
                                            aria-labelledby="codMethod" data-bs-parent="#checkoutAccordion">
                                            <div class="accordion-body">
                                                <input type="radio" id="cod" name="payment_method" value="cod" checked>
                                                <label for="cod">Pay when you receive the product at your doorstep.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="razorMethod">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#razorCollapse" aria-expanded="false" aria-controls="razorCollapse">
                                                Razorpay
                                            </button>
                                        </h2>
                                        <div id="razorCollapse" class="accordion-collapse collapse"
                                            aria-labelledby="razorMethod" data-bs-parent="#checkoutAccordion">
                                            <div class="accordion-body">
                                                <input type="radio" id="razorpay" name="payment_method" value="razorpay">
                                                <label for="razorpay">Secure online payment via Razorpay gateway.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-button-payment mt-20">
                                    <button type="submit" id="placeOrderBtn" class="fill-btn">
                                        <span class="fill-btn-inner">
                                            <span class="fill-btn-normal">Place Order</span>
                                            <span class="fill-btn-hover">Place Order</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- =================Checkout Area Ends================= -->


@endsection

@section('script')

<script>
    $(document).ready(function () {
        const formRow = $('#address-data-fild');
    
        function toggleFormRow() {
            const selectedValue = $('input[name="addrradio"]:checked').val();
    
            if (selectedValue === 'fornewaddr') {
                // Show the row and make fields required
                formRow.show();
                formRow.find('input, textarea, select').prop('required', true);
            } else {
                // Hide the row and remove the required attribute
                formRow.hide();
                formRow.find('input, textarea, select').prop('required', false);
            }
        }
    
        // Attach change event to the radio buttons
        $('input[name="addrradio"]').on('change', toggleFormRow);
    
        // Initialize row visibility based on default selection
        toggleFormRow();
    });
</script>

<!-- Include Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    $(document).ready(function () {
        $('#checkoutForm').on('submit', function (e) {
            e.preventDefault();

            let paymentMethod = $('input[name="payment_method"]:checked').val();
            let placeOrderBtn = $('#placeOrderBtn');
            placeOrderBtn.prop('disabled', true); // Disable button to prevent multiple clicks

            let formData = $(this).serialize();
            // Send AJAX request to process checkout
            $.ajax({
                url: '{{ route("checkout.process") }}',
                method: 'POST',
                dataType: "json",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        if (response.razorpay) {
                            // Open Razorpay payment gateway
                            let options = {
                                key: "{{ get_setting('razorpay_key') }}",
                                amount: response.amount,
                                currency: 'INR',
                                name: "{{ get_setting('company_name') }}",
                                description: 'Complete your order payment',
                                image: "{{ asset('assets/site-assets/img/fab.png') }}",
                                order_id: response.order_id,
                                prefill: {
                                    name: response.user.name,
                                    email: response.user.email,
                                    contact: response.user.phone,
                                },
                                handler: function (paymentResponse) {
                                    // Payment successful callback
                                    $.ajax({
                                        url: '{{ route("razorpay.callback") }}',
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        data: {
                                            razorpay_payment_id: paymentResponse.razorpay_payment_id
                                        },
                                        success: function (callbackResponse) {
                                            if (callbackResponse.success) {
                                                showToast('success', 'Success', callbackResponse.message);
                                                window.location.href = callbackResponse.redirect;
                                            } else {
                                                alert(callbackResponse.message);
                                                placeOrderBtn.prop('disabled', false);
                                            }
                                        },
                                        error: function () {
                                            alert('An error occurred while verifying the payment.');
                                            placeOrderBtn.prop('disabled', false);
                                        }
                                    });
                                },
                                theme: {
                                    color: "{{ get_setting('raz_colour_code') }}"
                                },
                                modal: {
                                    ondismiss: function () {
                                        // Handle Razorpay modal cancellation
                                        placeOrderBtn.prop('disabled', false); // Re-enable button on cancel
                                    }
                                }
                            };
                            let rzp = new Razorpay(options);
                            rzp.open();
                        } else {
                            // For COD, redirect directly
                            showToast('success', 'Success', response.message);
                            window.location.href = response.redirect;
                        }
                    } else {
                        alert(response.message);
                        placeOrderBtn.prop('disabled', false);
                    }
                },
                error: function () {
                    alert('An error occurred while processing the checkout.');
                    placeOrderBtn.prop('disabled', false);
                }
            });
        });
    });
</script>

@endsection