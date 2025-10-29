@extends('layouts.web-app')

@section('title') @yield('tab-title') @endsection

@section('style')
<style>
    .list-group-item {
        cursor: pointer;
    }
    .list-group-item.active {
        background-color: #fe0031;
        color: #fff;
        border-color: #fe0031;
    }
    .list-group-item.active a{
        color: #fff;
        font-weight: 700;
    }
</style>
@endsection

@section('content')

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
        <div class="breadcrumb__thumb" data-background="{{ get_setting('breadcrumb_banner', true) }}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Profile</h2>
                        <div class="breadcrumb__menu">
                        <nav>
                            <ul>
                                <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                <li><span>Profile</span></li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area start  -->
<div class="container py-5 dashboard">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            @include('site.user_dashboard.tabs')
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="tab-content">

                @yield('tab-pane-content')

            </div>
        </div>
    </div>
</div>

@endsection