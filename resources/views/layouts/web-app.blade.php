<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>@yield('title')  {{-- get_setting('site_title') --}}</title>
   @yield('meta')
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="{{ get_setting('favicon', true) }}">

   <!-- CSS here -->
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/meanmenu.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/animate.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/swiper.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/slick.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/magnific-popup.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/fontawesome-pro.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/spacing.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/css/grocery.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/site-assets/zoom/css/my-zoom.css') }}" />

   <!-- Toast message -->
    <link href="{{ asset('assets/admin-assets/plugins/toast/toastr.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .suggestions {
            position: absolute;
            background: #ffffff;
            width: 88%;
            /* border: 1px solid #ccc; */
            z-index: 1000;
            display: none;
            top: 59px;
            left: 37px;
        }
        .suggestions ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .suggestions li {
            padding: 10px;
            cursor: pointer;
        }
        .suggestions li:hover {
            background: #f8f8f8;
        }
    </style>
    @yield('style')

    {!! get_setting('header_script') !!}
</head>
<body class="hey-grocery">
    <!-- preloader start -->
    <div id="preloader">
        <div class="bd-loader-inner">
            <div class="bd-loader">
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
                <span class="bd-loader-item"></span>
            </div>
        </div>
    </div>
    <!-- preloader start -->

    <!-- Back to top start -->
    <div class="backtotop-wrap cursor-pointer">
        <svg class="backtotop-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Back to top end -->

    <!-- search area start -->
    <div class="df-search-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                <div class="df-search-form">
                    <div class="df-search-close text-center mb-20">
                        <button class="df-search-close-btn df-search-close-btn"></button>
                    </div>
                    <form action="#">
                        <div class="df-search-input mb-10">
                            <input type="text" placeholder="Search for product...">
                            <button type="submit"><i class="flaticon-search-1"></i></button>
                        </div>
                        <div class="df-search-category">
                            <span>Search by : </span>
                            <a href="#">Healthline, </a>
                            <a href="#">COVID-19, </a>
                            <a href="#">Surgery, </a>
                            <a href="#">Surgeon, </a>
                            <a href="#">Medical research</a>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- search area end -->

    <!-- Offcanvas area start -->
    <div class="fix">
        <div class="offcanvas__info grocery__offcanvas-info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="grocery.html">
                            <img src="{{ get_setting('logo', true) }}" alt="logo not found">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button class="grocery-bg">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="mobile-menu fix mb-40"></div>
                <div class="offcanvas__contact mt-30 mb-20">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                            <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                            <a class="grocery-clr-hover"
                                href="javascript:void(0);">{{ get_setting('address_1') }}</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                            <i class="far fa-phone"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                            <a class="grocery-clr-hover" href="tel:{{ get_setting('contact_phone_1') }}">{{ get_setting('contact_phone_1') }}</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                            <i class="fal fa-envelope"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                            <a class="grocery-clr-hover" href="{{ get_setting('email_1') }}"><span
                                    class="{{ get_setting('email_1') }}">{{ get_setting('email_1') }}</span></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas__social">
                    <ul>
                        @if(get_setting('facebook_link'))
                        <li><a href="{{ get_setting('facebook_link') }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if(get_setting('twitter_link'))
                        <li><a href="{{ get_setting('twitter_link') }}"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if(get_setting('youtube_link'))
                        <li><a href="{{ get_setting('youtube_link') }}"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if(get_setting('linkedin_link'))
                        <li><a href="{{ get_setting('linkedin_link') }}"><i class="fab fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>
    <div class="offcanvas__overlay-white"></div>
    <!-- Offcanvas area start -->

    <!-- Add cart modal area start -->
    <div class="product-modal-sm modal fade" id="producQuickViewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="product-modal">
                <div class="product-modal-wrapper p-relative">
                    <button type="button" class="close product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fal fa-times"></i>
                    </button>
                    <div class="modal__inner">
                        <div class="bd__shop-details-inner">
                            <div class="row">
                            <div class="col-xxl-6 col-lg-6">
                                <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                    <div class="product__details-thumb-tab mr-20">
                                        <nav>
                                        <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                                data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                                aria-selected="true">
                                                <img src="assets/imgs/product/details/details-07.png"
                                                    alt="product-sm-thumb">
                                            </button>
                                            <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                                aria-selected="false">
                                                <img src="assets/imgs/product/details/details-08.png"
                                                    alt="product-sm-thumb">
                                            </button>
                                            <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                                aria-selected="false">
                                                <img src="assets/imgs/product/details/details-09.png"
                                                    alt="product-sm-thumb">
                                            </button>
                                        </div>
                                        </nav>
                                    </div>
                                    <div class="product__details-thumb-tab-content">
                                        <div class="tab-content" id="productthumbcontent">
                                        <div class="tab-pane fade show active" id="img-1" role="tabpanel"
                                            aria-labelledby="img-1-tab">
                                            <div class="product__details-thumb-big w-img">
                                                <img src="assets/imgs/product/details/details-07.png" alt="">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="img-2" role="tabpanel"
                                            aria-labelledby="img-2-tab">
                                            <div class="product__details-thumb-big w-img">
                                                <img src="assets/imgs/product/details/details-08.png" alt="">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="img-3" role="tabpanel"
                                            aria-labelledby="img-3-tab">
                                            <div class="product__details-thumb-big w-img">
                                                <img src="assets/imgs/product/details/details-09.png" alt="">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-6">
                                <div class="product__details-content">
                                    <div class="product__details-top d-flex flex-wrap gap-3 align-items-center mb-15">
                                        <div class="product__details-tag">
                                        <a href="#">Construction</a>
                                        </div>
                                        <div class="product__details-rating">
                                        <a href="#"><i class="fa-solid fa-star"></i></a>
                                        <a href="#"><i class="fa-solid fa-star"></i></a>
                                        <a href="#"><i class="fa-regular fa-star"></i></a>
                                        </div>
                                        <div class="product__details-review-count">
                                        <a href="#">10 Reviews</a>
                                        </div>
                                    </div>
                                    <h3 class="product__details-title">Disposable Surgical Face Mask</h3>
                                    <div class="product__details-price">
                                        <span class="old-price">$30.35</span>
                                        <span class="new-price">$19.25</span>
                                    </div>
                                    <p>Priyoshop has brought to you the Hijab 3 Pieces Combo Pack PS23. It is a completely
                                        modern design and you feel comfortable to put on this hijab. Buy it at the best
                                        price.</p>

                                    <div class="product__details-action mb-35">
                                        <div class="product__quantity">
                                        <div class="product-quantity-wrapper">
                                            <form action="#">
                                                <button class="cart-minus"><i class="fa-light fa-minus"></i></button>
                                                <input class="cart-input" type="text" value="1">
                                                <button class="cart-plus"><i class="fa-light fa-plus"></i></button>
                                            </form>
                                        </div>
                                        </div>
                                        <div class="product__add-cart">
                                        <a href="javascript:void(0)" class="fill-btn cart-btn">
                                            <span class="fill-btn-inner">
                                                <span class="fill-btn-normal">Add To Cart<i
                                                    class="fa-solid fa-basket-shopping"></i></span>
                                                <span class="fill-btn-hover">Add To Cart<i
                                                    class="fa-solid fa-basket-shopping"></i></span>
                                            </span>
                                        </a>
                                        </div>
                                        <div class="product__add-wish">
                                        <a href="#" class="product__add-wish-btn"><i class="fa-solid fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product__details-meta">
                                        <div class="sku">
                                        <span>SKU:</span>
                                        <a href="#">BO1D0MX8SJ</a>
                                        </div>
                                        <div class="categories">
                                        <span>Categories:</span> <a href="#">Milk,</a> <a href="#">Cream,</a> <a
                                            href="#">Fermented.</a>
                                        </div>
                                        <div class="tag">
                                        <span>Tags:</span> <a href="#"> Cheese,</a> <a href="#">Custard,</a> <a
                                            href="#">Frozen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add cart modal area end -->

    <!-- Header area start -->

    @include('layouts.site-include.header')
    
    <!-- Header area end -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer area start -->
    @include('layouts.site-include.footer')
    <!-- Footer area end -->

    <!-- JS here -->
    <script src="{{ asset('assets/site-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/beforeafter.jquery-1.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/site-assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/site-assets/zoom/js/my-zoom.js') }}"></script>

    <!-- toast message -->
    <script src="{{ asset('assets/admin-assets/plugins/toast/toastr.js') }}"></script>
    <script src="{{ asset('assets/admin-assets/js/toastr.init.js') }}"></script>
    <!-- toast message -->
    
    @include('layouts._massages')
    @include('layouts.scripts.cart_script')
    @include('layouts.scripts.locations')

    <script>
        $(document).ready(function() {
            $('#search-box').on('keyup', function() {
                let query = $(this).val();
                // if (query.length > 2) {
                    $.ajax({
                        url: "{{ route('search.suggestions') }}",
                        method: "GET",
                        data: { query: query },
                        success: function(data) {
                            let suggestionHTML = '<ul>';
                            data.forEach(item => {
                                suggestionHTML += `<li class="suggestion-item" data-url="${item.url}">
                                                    <strong>${item.type ? item.type + ': ' : ''}</strong> ${item.name}
                                                </li>`;
                            });
                            suggestionHTML += '</ul>';
                            $('#suggestions-box').html(suggestionHTML).show();
                        }
                    });
                // } else {
                //     $('#suggestions-box').hide();
                // }
            });

            $(document).on('click', '.suggestion-item', function() {
                window.location.href = $(this).data('url'); // Redirect to the selected item's URL
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('#search-box, #suggestions-box').length) {
                    $('#suggestions-box').hide();
                }
            });
        });
    </script>


    @yield('script')

    {!! get_setting('footer_script') !!}
</body>
</html>