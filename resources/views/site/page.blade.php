@extends('layouts.web-app')

@section('title')
    {{ $page->meta_title ?? $page->name ?? 'Unknown' }}
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
                        <h2 class="breadcrumb__title">{{ $page->name }}</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>{{ $page->name }}</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->

    <section class="about-area pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="wow fadeInRight animated" data-wow-delay="0.3s">
                        {!! $page->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection