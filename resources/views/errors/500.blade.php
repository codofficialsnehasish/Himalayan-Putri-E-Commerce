@extends('layouts.web-app')

@section('title')
    500 Error
@endsection

@section('content')

    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ get_setting('breadcrumb_banner', true) }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Internal Server Error</h2>
                        <div class="breadcrumb__menu">
                            <nav>
                                <ul>
                                    <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                    <li><span>500</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="error-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-md-6">
                    <div class="error-thumb w-img mb-50">
                        <img src="{{ asset('assets/site-assets/imgs/bg/error.png') }}" alt="Error Image">
                    </div>
                    <div class="error-content text-center">
                        <h2 class="section-title">Whoops! Something went wrong on our end.</h2>
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

@endsection
