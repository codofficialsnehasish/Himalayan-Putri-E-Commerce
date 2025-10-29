@extends('layouts.web-app')

@section('title')
    403 Forbidden
@endsection

@section('content')

    <!-- Breadcrumb area start -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ get_setting('breadcrumb_banner', true) }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Access Denied</h2>
                        <div class="breadcrumb__menu">
                            <nav>
                                <ul>
                                    <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                    <li><span>403</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->

    <!-- Error area start -->
    <section class="error-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="error-thumb w-img mb-50">
                        <img src="{{ asset('assets/site-assets/imgs/bg/error.png') }}" alt="Access Denied">
                    </div>
                    <div class="error-content text-center">
                        <h2 class="section-title">Oops! You don’t have permission to access this page.</h2>
                        <p class="mb-30 text-muted">Please check your account privileges or contact the administrator if you think this is a mistake.</p>
                        <a href="{{ route('home') }}" class="fill-btn">
                            <span class="fill-btn-inner">
                                <span class="fill-btn-normal">go back home <i class="fa-regular fa-angle-right"></i></span>
                                <span class="fill-btn-hover">go back home <i class="fa-regular fa-angle-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Error area end -->

@endsection
