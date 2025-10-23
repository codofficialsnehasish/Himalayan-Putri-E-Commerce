@extends('layouts.web-app')

@section('title') Contact Us @endsection

@section('content')

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ asset('assets/site-assets/imgs/bg/breadcrumb-bg.jpg') }}"></div>
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
                        <p><a href="https://maps.app.goo.gl/911yNjKGCTog4zeq8">Shed No:04, Ind. Area, Phase II, Nagrota Bagwan, Himachal Pradesh 176047</a></p>
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
                        <span><a href="mailto:info@himalayanputri.com">info@himalayanputri.com</a></span>
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
                        <span><a href="mailto:+918091451734">+91 8091451734</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-wrapper pt-80">
                <div class="row gy-50">
                    <div class="col-xxl-6 col-xl-6">
                        <div class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3379.6642856800227!2d76.3788839!3d32.1053578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391b4c31055234ad%3A0x8b55f68a2c8e85b!2sHimalayan%20Putri-%20Best%20Naturopathic%20Practitioner%20in%20India%2C%20Weight%20Loss%20and%20Ashtanga%20Yoga!5e0!3m2!1sen!2sin!4v1761126067419!5m2!1sen!2sin"></iframe>
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