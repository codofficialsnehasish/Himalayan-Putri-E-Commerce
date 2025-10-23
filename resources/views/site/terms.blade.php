@extends('layouts.web-app')

@section('title') Terms & Conditions @endsection

@section('content')

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ asset('assets/site-assets/imgs/bg/breadcrumb-bg.jpg') }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Terms & Conditions</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>Terms & Conditions</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <!-- Terms & Conditions area start -->
    <section class="about-area pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="wow fadeInRight animated" data-wow-delay="0.3s">
                        <div class="mb-20">
                            <span class="mb-15" style="color: #B18B5E;">TERMS & CONDITIONS</span>
                            <h3>Welcome to {{ env('APP_NAME') }}</h3>
                        </div>

                        <p>By accessing or using our website, you agree to comply with and be bound by the following Terms and Conditions. Please read them carefully before making any purchase or using our services.</p>

                        <h5 class="mt-40">1. General Information</h5>
                        <p>{{ env('APP_NAME') }} is an online store that offers quality products at fair prices. All users must be at least 18 years old or have parental consent to make purchases on our platform.</p>

                        <h5 class="mt-40">2. Product Information</h5>
                        <p>We strive to ensure that all product descriptions, images, and prices are accurate. However, minor variations may occur. Colors may appear slightly different due to monitor settings or lighting conditions.</p>

                        <h5 class="mt-40">3. Orders & Payments</h5>
                        <p>All orders are subject to acceptance and availability. Once your order is placed, you will receive a confirmation email. Payment must be made in full at the time of order using the accepted payment methods displayed on our site.</p>

                        <h5 class="mt-40">4. Shipping & Delivery</h5>
                        <p>Delivery times may vary depending on your location. {{ env('APP_NAME') }} is not responsible for delays caused by third-party courier services or unforeseen circumstances such as natural disasters.</p>

                        <h5 class="mt-40">5. Returns & Refunds</h5>
                        <p>If you receive a damaged or defective item, please contact us within 7 days of delivery. Returns are accepted only if the product is unused, in its original packaging, and accompanied by proof of purchase.</p>

                        <h5 class="mt-40">6. Intellectual Property</h5>
                        <p>All content, including images, text, and logos on this website, are the property of {{ env('APP_NAME') }} and protected by copyright laws. Unauthorized use or reproduction is strictly prohibited.</p>

                        <h5 class="mt-40">7. Privacy Policy</h5>
                        <p>Your personal information is handled in accordance with our Privacy Policy. We do not sell or share your data with third parties without your consent.</p>

                        <h5 class="mt-40">8. Limitation of Liability</h5>
                        <p>{{ env('APP_NAME') }} shall not be liable for any direct, indirect, or incidental damages arising from the use or inability to use our website or products.</p>

                        <h5 class="mt-40">9. Changes to Terms</h5>
                        <p>We reserve the right to modify or update these Terms and Conditions at any time without prior notice. The updated terms will be effective immediately upon posting on this page.</p>

                        <p class="mt-40"><strong>By using our website, you acknowledge that you have read, understood, and agree to these Terms and Conditions.</strong></p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Terms & Conditions area end -->

@endsection