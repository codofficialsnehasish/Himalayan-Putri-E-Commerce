@extends('layouts.web-app')

@section('title') Return Policy @endsection

@section('content')

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ asset('assets/site-assets/imgs/bg/breadcrumb-bg.jpg') }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Return Policy</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>Return Policy</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <!-- Return & Refund Policy area start -->
    <section class="about-area pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="wow fadeInRight animated" data-wow-delay="0.3s">
                        <div class="mb-20">
                            <span class="mb-15" style="color: #B18B5E;">RETURN & REFUND POLICY</span>
                            <h3>Customer Satisfaction is Our Priority</h3>
                        </div>

                        <p>At {{ env('APP_NAME') }}, we take pride in delivering high-quality products and exceptional service. However, if you are not completely satisfied with your purchase, we’re here to help. Please read our Return & Refund Policy carefully before making a request.</p>

                        <h5 class="mt-40">1. Eligibility for Returns</h5>
                        <p>To be eligible for a return, your item must be unused, in the same condition as received, and in its original packaging. The return request must be made within <strong>7 days</strong> of receiving your order.</p>

                        <h5 class="mt-40">2. Non-Returnable Items</h5>
                        <p>Some products cannot be returned, including personalized or custom-made items, discounted or clearance products, and items damaged due to mishandling after delivery.</p>

                        <h5 class="mt-40">3. Damaged or Defective Products</h5>
                        <p>If you receive a damaged, defective, or incorrect item, please contact our customer support within <strong>48 hours</strong> of delivery with photos or videos as proof. Once verified, we will arrange for a replacement or refund.</p>

                        <h5 class="mt-40">4. Return Process</h5>
                        <p>To initiate a return, contact our support team through the contact form or email mentioned on our website. Once your return is approved, you will receive instructions for shipping the item back to us. Customers are responsible for return shipping costs unless the product is defective or incorrect.</p>

                        <h5 class="mt-40">5. Refunds</h5>
                        <p>After we receive and inspect your returned item, we will notify you of the status of your refund. If approved, your refund will be processed within <strong>7–10 business days</strong> and credited to your original payment method.</p>

                        <h5 class="mt-40">6. Exchange Policy</h5>
                        <p>We currently do not offer direct exchanges. If you wish to replace an item, please return it for a refund and place a new order for your desired product.</p>

                        <h5 class="mt-40">7. Late or Missing Refunds</h5>
                        <p>If you haven’t received your refund yet, please check with your bank or credit card provider. Processing times vary depending on financial institutions. If you still haven’t received your refund after 15 days, please contact us for assistance.</p>

                        <h5 class="mt-40">8. Contact Us</h5>
                        <p>If you have any questions about our Return & Refund Policy, please contact our customer service team at <strong>info@himalayanputri.com</strong>.</p>

                        <p class="mt-40"><strong>By purchasing from {{ env('APP_NAME') }}, you agree to this Return & Refund Policy.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Return & Refund Policy area end -->


@endsection