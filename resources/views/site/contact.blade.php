@extends('layouts.web-app')

@php
    use App\Models\Page;
    $page = Page::where('slug', 'contact')->orWhere('slug','contact-us')->first(); 
@endphp
@section('title')
    {{ $page->meta_title ?? $page->name ?? 'Contact Us' }}
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
                        <h2 class="breadcrumb__title">Contact</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>Contact</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <!-- Contact area start -->
    <div class="contact-area section-space">
        <div class="container">
            <div class="row g-5">
                <div class="col-xxl-4 col-xl-4 col-lg-6">
                    <div class="contact-info-item text-center">
                        <div class="contact-info-icon">
                            <span><i class="fa-light fa-location-dot"></i></span>
                        </div>
                        <div class="contact-info-content">
                        <h4>Our Location</h4>
                            @if(get_setting('address_1'))
                                <p>{{ get_setting('address_1') }}</p>
                            @endif

                            @if(get_setting('address_2'))
                                <p class="mt-3">{{ get_setting('address_2') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-6">
                    <div class="contact-info-item text-center">
                        <div class="contact-info-icon">
                            <span><i class="fa-light fa-envelope"></i></span>
                        </div>
                        <div class="contact-info-content">
                            <h4>Our Email Address</h4>
                            @if(get_setting('email_1'))
                                <span><a href="mailto:{{ get_setting('email_1') }}">{{ get_setting('email_1') }}</a></span>
                            @endif

                            @if(get_setting('email_2'))
                                <span><a href="mailto:{{ get_setting('email_2') }}">{{ get_setting('email_2') }}</a></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-6">
                    <div class="contact-info-item text-center">
                        <div class="contact-info-icon">
                            <span><i class="fa-thin fa-phone"></i></span>
                        </div>
                        <div class="contact-info-content">
                        <h4>Contact Phone Number</h4>
                            @if(get_setting('contact_phone_1'))
                                <span><a href="tel:{{ get_setting('contact_phone_1') }}">{{ get_setting('contact_phone_1') }}</a></span>
                            @endif

                            @if(get_setting('contact_phone_2'))
                                <span><a href="tel:{{ get_setting('contact_phone_2') }}">{{ get_setting('contact_phone_2') }}</a></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-wrapper pt-80">
                <div class="row gy-50">
                    <div class="col-xxl-6 col-xl-6">
                        <div class="contact-map">
                            {!! get_setting('google_map_iframe') !!}
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6">
                        <div class="contact-from">
                            <form action="{{ route('contact.store') }}"  method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="contact__from-input">
                                        <input type="text" placeholder="Full Name*" name="name" value="{{ old('name') }}" id="name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact__from-input">
                                        <input type="email" placeholder="Email Address*" name="email" value="{{ old('email') }}" id="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact__from-input">
                                        <input type="tel" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" id="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact__from-input">
                                        <textarea placeholder="Your Message" name="message" id="text-area">{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="appointment__btn">
                                        <button class="fill-btn" type="submit">
                                            <span class="fill-btn-inner">
                                                <span class="fill-btn-normal">send now<i
                                                    class="fa-regular fa-angle-right"></i></span>
                                                <span class="fill-btn-hover">send now<i
                                                    class="fa-regular fa-angle-right"></i></span>
                                            </span>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact area end -->

@endsection