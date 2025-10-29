    <footer class="footer-bg">
        <div class="footer-area section-space-medium">
            <div class="footer-style-4">
                <div class="container">
                <div class="footer-grid-3">
                    <div class="footer-widget-4">
                        <div class="footer-logo mb-35">
                            <a href="{{ route('home') }}"><img src="{{ get_setting('logo', true) }}"
                                alt="image bnot found"></a>
                        </div>
                        <p>It helps designers plan out where the content will sit, the content to be written and approved.
                        </p>
                        <div class="theme-social">
                            @if(get_setting('facebook_link'))
                            <a class="grocery-bg-hover" href="{{ get_setting('facebook_link') }}"><i class="fa-brands fa-facebook-f"></i></a>
                            @endif
                            @if(get_setting('twitter_link'))
                            <a class="grocery-bg-hover" href="{{ get_setting('twitter_link') }}"><i class="fa-brands fa-twitter"></i></a>
                            @endif
                            @if(get_setting('linkedin_link'))
                            <a class="grocery-bg-hover" href="{{ get_setting('linkedin_link') }}"><i class="fa-brands fa-linkedin-in"></i></a>
                            @endif
                            @if(get_setting('youtube_link'))
                            <a class="grocery-bg-hover" href="{{ get_setting('youtube_link') }}"><i class="fa-brands fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="footer-widget-4">
                        <div class="footer-widget-title">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About us </a></li>
                                @auth
                                <li><a href="{{ route('user-dashboard.profile') }}">My Profile</a></li>
                                @else
                                <li><a href="{{ route('login') }}">Log In</a></li>
                                @endauth
                                <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                                <li><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-widget-4">
                        <div class="footer-widget-title">
                            <h4>Company</h4>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="{{ route('page','return-policy') }}">Return Policy</a></li>
                                <li><a href="{{ route('page','terms-conditions') }}">Terms & Condition</a></li>
                                <li><a href="{{ route('page','privacy-policy') }}">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-widget footer-col-4">
                        <div class="footer-widget-title">
                            <h4>Contact</h4>
                        </div>
                        <div class="footer-info mb-35">
                            @if(get_setting('address_1'))
                            <p class="w-75">{{ get_setting('address_1') }}</p>
                            @endif
                            <div class="footer-info-item d-flex align-items-start pb-15 pt-15">
                                <div class="footer-info-icon mr-20">
                                    <span> <i class="fa-solid fa-envelope grocery-icon"></i></span>
                                </div>
                                <div class="footer-info-text">
                                    @if(get_setting('email_1'))
                                        <a class="grocery-clr-hover" href="mailto:{{ get_setting('email_1') }}">{{ get_setting('email_1') }}</a>
                                    @endif

                                    @if(get_setting('email_2'))
                                        <a class="grocery-clr-hover" href="mailto:{{ get_setting('email_2') }}">{{ get_setting('email_2') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="footer-info-item d-flex align-items-start">
                                <div class="footer-info-icon mr-20">
                                    <span><i class="fa-solid fa-phone grocery-icon"></i></span>
                                </div>
                                <div class="footer-info-text">
                                    @if(get_setting('contact_phone_1'))
                                    <a class="grocery-clr-hover" href="tel:012-345-6789">{{ get_setting('contact_phone_1') }}</a>
                                    @endif
                                    @if(get_setting('contact_phone_2'))
                                    <a class="grocery-clr-hover" href="tel:012-345-6789">{{ get_setting('contact_phone_2') }}</a>
                                    @endif
                                    {{-- <p>Mon - Sat: 9 AM - 5 PM</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-copyright-area b-t">
                <div class="footer-copyright-wrapper">
                <div class="footer-copyright-text">
                    <p class="mb-0">© <strong>{{ env('APP_NAME') }}</strong>. Designed with ❤️ by <a href="https://codeofdolphins.com/" target="_blank">Code of Dolphins</a>. All rights reserved.</p>
                </div>
                <div class="footer-payment d-flex align-items-center gap-2">
                    <div class="footer-payment-item mb-0">
                        <div class="footer-payment-thumb">
                            <img src="{{ asset('assets/site-assets/imgs/icons/payoneer.png') }}" alt="">
                        </div>
                    </div>
                    <div class="footer-payment-item mb-0">
                        <div class="footer-payment-thumb">
                            <img src="{{ asset('assets/site-assets/imgs/icons/maser.png') }}" alt="">
                        </div>
                    </div>
                    <div class="footer-payment-item">
                        <div class="footer-payment-thumb">
                            <img src="{{ asset('assets/site-assets/imgs/icons/paypal.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="footer-conditions">
                    <ul>
                        <li><a class="grocery-clr-hover" href="{{ route('page','terms-conditions') }}">Terms & Condition</a></li>
                        <li><a class="grocery-clr-hover" href="{{ route('page','privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </footer>