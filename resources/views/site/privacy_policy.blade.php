@extends('layouts.web-app')

@section('title') Privacy Policy @endsection

@section('content')

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ asset('assets/site-assets/imgs/bg/breadcrumb-bg.jpg') }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Privacy Policy</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>Privacy Policy</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <!-- Privacy Policy area start -->
    <section class="about-area pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="wow fadeInRight animated" data-wow-delay="0.3s">
                        <div class="mb-20">
                            <span class="mb-15" style="color: #B18B5E;">PRIVACY POLICY</span>
                            <h3>Your Privacy Matters to Us</h3>
                        </div>

                        <p>At {{ env('APP_NAME') }}, we value your trust and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you use our website or make a purchase.</p>

                        <h5 class="mt-40">1. Information We Collect</h5>
                        <p>We collect personal details that you provide when you register, place an order, or contact us, including your name, email, phone number, billing/shipping address, and payment information. We may also collect non-personal data such as your browser type and IP address for analytics purposes.</p>

                        <h5 class="mt-40">2. How We Use Your Information</h5>
                        <p>Your information helps us process your orders, improve our website, communicate updates, and provide customer support. We may also use your data to send promotional offers, but only if you have opted in to receive them.</p>

                        <h5 class="mt-40">3. Data Protection & Security</h5>
                        <p>We use advanced encryption and secure payment gateways to protect your personal and financial data. Access to personal information is restricted to authorized personnel only, and all information is stored on secure servers.</p>

                        <h5 class="mt-40">4. Cookies</h5>
                        <p>Our website uses cookies to enhance your browsing experience. Cookies help us remember your preferences and improve site performance. You can choose to disable cookies through your browser settings, but this may affect certain site functions.</p>

                        <h5 class="mt-40">5. Third-Party Services</h5>
                        <p>We may use third-party service providers (such as payment gateways and delivery partners) to fulfill orders and process payments. These partners are required to maintain the confidentiality and security of your information.</p>

                        <h5 class="mt-40">6. Sharing Your Information</h5>
                        <p>{{ env('APP_NAME') }} does not sell, trade, or rent users' personal information to others. We may share limited data only when required by law or to protect our rights and safety.</p>

                        <h5 class="mt-40">7. Your Rights</h5>
                        <p>You have the right to access, update, or delete your personal information. To exercise these rights, please contact us through our official communication channels listed on our website.</p>

                        <h5 class="mt-40">8. Policy Updates</h5>
                        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal reasons. Please review this page periodically for the latest version.</p>

                        <p class="mt-40"><strong>By using our website, you consent to the collection and use of your information as outlined in this Privacy Policy.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Privacy Policy area end -->


@endsection