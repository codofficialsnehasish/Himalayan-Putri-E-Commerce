    <footer class="footer-bg">
        <div class="footer-area section-space-medium">
            <div class="footer-style-4">
                <div class="container">
                <div class="footer-grid-3">
                    <div class="footer-widget-4">
                        <div class="footer-logo mb-35">
                            <a href="{{ route('home') }}"><img src="{{ asset('assets/site-assets/imgs/grocery/logo/logo.png') }}"
                                alt="image bnot found"></a>
                        </div>
                        <p>It helps designers plan out where the content will sit, the content to be written and approved.
                        </p>
                        <div class="theme-social">
                            <a class="grocery-bg-hover" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a class="grocery-bg-hover" href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a class="grocery-bg-hover" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a class="grocery-bg-hover" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="footer-widget-4">
                        <div class="footer-widget-title">
                            <h4>Services</h4>
                        </div>
                        <div class="footer-link">
                            <ul>
                                @auth
                                <li><a href="{{ route('user-dashboard.profile') }}">My Profile</a></li>
                                @else
                                <li><a href="{{ route('login') }}">Log In</a></li>
                                @endauth
                                <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                                <li><a href="{{ route('return-policy') }}">Return Policy</a></li>
                                <li><a href="{{ route('terms-and-conditions') }}">Terms & Condition</a></li>
                                <li><a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-widget-4">
                        <div class="footer-widget-title">
                            <h4>Company</h4>
                        </div>
                        <div class="footer-link">
                            <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About us </a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-widget footer-col-4">
                        <div class="footer-widget-title">
                            <h4>Contact</h4>
                        </div>
                        <div class="footer-info mb-35">
                            <p class="w-75">Shed No:04, Ind. Area, Phase II, Nagrota Bagwan, Himachal Pradesh 176047</p>
                            <div class="footer-info-item d-flex align-items-start pb-15 pt-15">
                            <div class="footer-info-icon mr-20">
                                <span> <i class="fa-solid fa-location-dot grocery-icon"></i></span>
                            </div>
                            <div class="footer-info-text">
                                <a class="grocery-clr-hover" target="_blank"
                                    href="https://maps.app.goo.gl/911yNjKGCTog4zeq8">Himachal Pradesh, 176047</a>
                            </div>
                            </div>
                            <div class="footer-info-item d-flex align-items-start">
                            <div class="footer-info-icon mr-20">
                                <span><i class="fa-solid fa-phone grocery-icon"></i></span>
                            </div>
                            <div class="footer-info-text">
                                <a class="grocery-clr-hover" href="tel:012-345-6789">+91 8091451734</a>
                                <p>Mon - Sat: 9 AM - 5 PM</p>
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
                        <li><a class="grocery-clr-hover" href="{{ route('terms-and-conditions') }}">Terms & Condition</a></li>
                        <li><a class="grocery-clr-hover" href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </footer>