@extends('layouts.web-app')
@php
    use App\Models\Page;
    $page = Page::where('slug', 'about')->orWhere('slug','about-us')->first(); 
@endphp
@section('title')
    {{ $page->meta_title ?? $page->name ?? 'About Us' }}
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
                        <h2 class="breadcrumb__title">About us</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>About Us</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <!-- About area start -->
    <section class="about-area pt-120 pb-120">
        <div class="container">
        <div class="row g-4">
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="wow fadeInRight animated" data-wow-delay="0.3s">
                    <div class="mb-20">
                        <span class="mb-15">PURE. NATURAL. SUSTAINABLE.</span>
                        <h3>Our Core Divisions</h3>
                    </div>
                    <p>
                        We believe in delivering nature’s goodness straight to your doorstep. 
                        Our mission is to promote a healthy lifestyle by providing 100% organic, 
                        chemical-free products sourced directly from trusted local farmers. 
                        From fresh produce to handcrafted wellness essentials, we ensure purity in every product we offer.
                    </p>
                    
                    <div class="bd-skill__progress mt-40 mb-60">
                        <div class="bd-progress__skill-item fix">
                            <h5>Organic Farming</h5>
                            <div class="progress">
                                <div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s"
                                    role="progressbar" data-width="90%" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: 90%; visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: slideInLeft;">
                                </div>
                            </div>
                            <span class="progress-count">90%</span>
                        </div>

                        <div class="bd-progress__skill-item fix">
                            <h5>Natural Skincare</h5>
                            <div class="progress">
                                <div class="progress-bar wow slideInLeft" data-wow-duration="1s" data-wow-delay=".3s"
                                    role="progressbar" data-width="75%" aria-valuenow="75" aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: 75%; visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: slideInLeft;">
                                </div>
                            </div>
                            <span class="progress-count">75%</span>
                        </div>

                        <div class="bd-progress__skill-item fix">
                            <h5>Eco-friendly Packaging</h5>
                            <div class="progress">
                                <div class="progress-bar wow slideInLeft" data-wow-duration="1.5s" data-wow-delay=".3s"
                                    role="progressbar" data-width="85%" aria-valuenow="85" aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: 85%; visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: slideInLeft;">
                                </div>
                            </div>
                            <span class="progress-count">85%</span>
                        </div>
                    </div>

                    <img class="w-100" src="{{ asset('assets/site-assets/imgs/grocery/about/about-image2.jpg') }}" alt="Organic Products">
                </div>

            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <img class="w-100 pl-50" src="{{ asset('assets/site-assets/imgs/grocery/about/about-image1.jpg') }}" alt="">
            </div>
        </div>
        </div>
    </section>
    <!-- About area end -->

    <!-- About video area start -->
    <div class="postbox__thumb postbox__video w-img p-relative">
        <a href="blog-details.html">
        <img src="{{ asset('assets/site-assets/imgs/grocery/about/about-video-image.jpg') }}" alt="image">
        </a>
        <a href="https://www.youtube.com/watch?v=xC-vlUooCug" class="play-btn pulse-btn popup-video"><i
            class="fas fa-play"></i></a>
    </div>
    <!-- About video area end -->
@endsection