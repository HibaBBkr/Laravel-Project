@extends('layouts.sallety') {{-- Or whatever your main layout file is named --}}

@section('title', 'EventHalls - Home')

@section('stylesheets')
    {{-- Styles specific to the Home page --}}
    <link rel="stylesheet" href="{{ asset('css/Style_Home.css') }}">
        <style>/*
            .pro-header {
                background-color: transparent;
                position: absolute;
                width: 100%;
                z-index: 10;
            }
        */</style>
@endsection

@section('content')
    @guest
        <nav class="guest-nav" style="position: absolute;"> {{-- Added class for potential specific styling --}}
            <div class="logo">
                <img src="{{ asset('pictures/logo.png') }}" alt="EventHalls Logo"
                    height="70" />
            </div>
            <ul class="nav-links">
            <li><a href="{{ route('Home') }}">Home</a></li>
            <li><a href="#">Why us?</a></li> 
                <li><a><div class="language-menu">
                            <img
                                src="https://cdn-icons-png.flaticon.com/512/44/44386.png"
                                alt="Globe" class="globe-icon"
                                onclick="toggleLangMenu()"> 
                            <div class="lang-options" id="langOptions">
                                <div onclick="setLang('en')">EN</div>
                                <div onclick="setLang('fr')">FR</div>
                                <div onclick="setLang('ar')">AR</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <button id="openLoginModalButton" style="margin: 20px;">Log in</button>
                    <button id="openSignupModalButton" style="margin: 20px;">Sign Up</button>
                </li>
            </ul>
        </nav>
    @endguest


    <header class="first-section" @auth  @endauth> {{-- Add margin-top if logged in to account for fixed pro-header --}}
            <h1 style="font-size: 60px;">Find Your Dream!!</h1>
            <p style="font-size: 46px; max-width: 1020px;">Our halls are
                equipped with everything you need for a successful event.</p>
    </header>

    <section class="arabic-banner">
            <h2 style="font-size: 46px;">ليلة العمر تستحق مكانًا مميّزًا!!</h2>
            <p style="font-size: 42px;">وفر لك القاعة المثالية لتجربة استثنائية
                مليئة بالسعادة</p>
    </section>

    <section class="why-us">
            <h2>Why Us ??</h2>
            <ul>
                <li>All the options in one place!</li>
                <li>Your important meeting, with ease and joy!</li>
                <li>We care about the small details so you can focus on the big
                    ones!</li>
            </ul>
            <button
                style="margin-top: 20px; padding: 10px 20px; background: white; border: none; border-radius: 4px;">Read
                more</button>
    </section>

    <section class="newsletter">
            <h3>Subscribe to our weekly newsletter</h3>
            <p>Enter your email address and we'll send you our updates</p>
            <input type="email" placeholder="Email" />
            <button><i class="fas fa-paper-plane"></i></button>
    </section>

    <footer class="footer">
            <div>
                <h2>EventHalls</h2>
                <div class="social-icons">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
            <div>
                <h4>Important links</h4>
                <p><a href="{{ route('Home') }}">Home</a></p>
                <p><a href="HallListing.html">Halls</a></p> {{-- Use route() --}}
                <p><a href="whyus.html">Why us?</a></p> {{-- Use route() --}}
                <p><a href="#">Terms and conditions</a></p>
                <p><a href="#">Privacy Policy</a></p>
            </div>
            <div>
                <h4>Contact us</h4>
                <p>Ouargla, Algeria</p>
                <p><a
                        href="mailto:info@eventhall.com.dz">info@eventhall.com.dz</a></p>
                <p>+2135******75</p>
            </div>
    </footer>
    @guest
            <div class="login-modal" id="loginModal">
                <div class="modal-box">
                    <div class="close-btn">×</div>
                    <h2>Welcome back</h2>
                    <p>Please enter the following details to log in.</p>
        
                    <button type="button" class="social-btn">
                        <img src="{{ asset('pictures/google.png') }}" alt="Google">
                        Continue with Google
                    </button>
                    <button type="button" class="social-btn">
                        <img src="{{ asset('pictures/apple.png') }}" alt="Apple">
                        Continue with Apple
                    </button>
                    <button type="button" class="social-btn">
                        <img src="{{ asset('pictures/facebook.png') }}" alt="Facebook">
                        Continue with Facebook
                    </button>
        
                    <div class="divider">
                        <hr>
                        <span>or</span>
                        <hr>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger" style="color: red; font-size: 10px;">
                        @foreach($errors->all() as $error)
                            <li style="margin: 0 5px;">{{ $error }}</li>
                        @endforeach
                        </div>
                    @endif
                    <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
                        @csrf  {{-- <--- THIS IS CRUCIAL --}}

                        <input type="hidden" name="form_type" value="login">

                        <div class="field">
                            <label for="login-email">Email</label>
                            <input type="email" id="login-email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="field">
                            <label for="login-password">Password</label>
                            <input type="password" id="login-password" name="password" required>
                        </div>
                        
                        <div class="field-row">
                            <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Remember me</label>
                            </div>
                            <div class="forgot-password-link">
                                <a href="#">forgot password?</a>
                            </div>
                        </div>
        
                        <button type="submit" class="action-btn">Log In</button>
                    </form>
        
                    <div class="footer-text">
                        Don't have an account? <a href="#" id="loginToSignupLink">Sign Up</a>
                    </div>
                </div>
            </div>

            
            <div class="signup-modal" id="signupModal">
                <div class="modal-box">
                    <div class="close-btn">×</div>
                    <h2>Join EventHalls</h2>
                    <p>Create a new account</p>
                    
                    <!-- Role Selector -->
                    
                    <div class="role-selector">
                        <button type="button" class="role-btn active" data-role="customer">Customer</button> 
                        <button type="button" class="role-btn" data-role="owner">Hall Owner</button>
                    </div>
                    <form id="custumerSignupForm" method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data">                    
                        @csrf  {{-- <--- THIS IS CRUCIAL --}}

                        <div class="form-section" id="customerFormFields">
                            <input type="hidden" name="role" id="sign-customer-role" value="customer">
                            <button type="button" class="social-btn">
                                <img src="{{ asset('pictures/google.png') }}" alt="Google">
                                Sign up with Google
                            </button>
                            <button type="button" class="social-btn">
                                <img src="{{ asset('pictures/apple.png') }}" alt="Apple">
                                Sign up with Apple
                            </button>
                            <button type="button" class="social-btn">
                                <img src="{{ asset('pictures/facebook.png') }}" alt="Facebook">
                                Sign up with Facebook
                            </button>
                            <div class="divider">
                                <hr><span>or</span><hr>
                            </div>

                            @if($errors->any() && old('form_type') !== 'login') {{-- Show errors only if they are for signup --}}
                            <div class="alert alert-danger" style="color: red; font-size: 10px;">
                                @foreach($errors->all() as $error)
                                    <li style="margin: 0 5px;">{{ $error }}</li>
                                @endforeach
                            </div>
                            @endif

                            <div class="field">
                                <label for="signup-customer-name">Full Name</label>
                                <input type="text" id="signup-customer-name" name="name" required>
                            </div>

                            <div class="field">
                                <label for="signup-customer-email">Email</label>
                                <input type="email" id="signup-customer-email" name="email" required>
                            </div>

                            <div class="field">
                                <label for="signup-customer-phone_number">Phone Number</label>
                                <input type="tel" id="signup-customer-phone_number" name="phone_number">

                            </div>
                            <div class="field">
                                <label for="signup-customer-password">Password</label>
                                <input type="password" id="signup-customer-password" name="password" required>
                            </div>

                            <div class="field">
                                <label for="signup-customer-password_confirmation">Confirm Password</label>
                                <input type="password" id="signup-customer-password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="action-btn">Sign Up</button>
                    </form>
                    <!-- Hall Owner Specific Fields -->
                    <form id="ownerSignupForm" method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data"  style="display: none;">   
                        @csrf             
                        <input type="hidden" name="role" id="sign-owner-role" value="owner">    
                        <div class="form-section" id="ownerFormFields">
                            @if($errors->any() && old('form_type') !== 'login') {{-- Show errors only if they are for signup --}}
                                <div class="alert alert-danger" style="color: red; font-size: 10px;">
                                    @foreach($errors->all() as $error)
                                        <li style="margin: 0 5px;">{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="field">
                                <label for="signup-owner-name">Full Name</label>
                                <input type="text" id="signup-owner-name" name="name" required>
                            </div>

                            <div class="field">
                                <label for="signup-owner-email">Email</label>
                                <input type="email" id="signup-owner-email" name="email" required>
                            </div>

                            <div class="field">
                                <label for="signup-owner-phone_number">Phone Number</label>
                                <input type="tel" id="signup-owner-phone_number" name="phone_number">

                            </div>
                            <div class="field">
                                <label for="signup-owner-password">Password</label>
                                <input type="password" id="signup-owner-password" name="password" required>
                            </div>

                            <div class="field">
                                <label for="signup-owner-password_confirmation">Confirm Password</label>
                                <input type="password" id="signup-owner-password_confirmation" name="password_confirmation">
                            </div>
                            <div class="field">
                                <label for="signup-id-card">ID Card Number</label>
                                <input type="text" id="signup-id-card" name="id_card_number" required>
                            </div>
                            <div class="file-upload-wrapper">
                                <label for="hall-license-file">Hall Ownership License</label>
                                <div class="file-input-custom">
                                    <input type="text" id="hall-license-filename"  placeholder="No file chosen" readonly class="file-display-input">
                                    <input type="file" id="hall-license-file" name="license_file" class="hidden-file-input" accept="image/*,.pdf,.doc,.docx">
                                    <button type="button" class="upload-btn" onclick="document.getElementById('hall-license-file').click();">Upload Picture</button>
                                </div>
                            </div>
                            <div class="terms-agreement">
                                <input type="checkbox" id="signup-terms" name="terms" required>
                                <label for="signup-terms" class="checkbox-label">I agree to the <span>Terms and Conditions</span></label>
                            </div>
                        </div>

                        <button type="submit" class="action-btn">Sign Up</button>
                    </form>
        
                    <div class="footer-text">
                        Already have an account? <a href="#" id="signupToLoginLink">Log in</a>
                    </div>
                </div>
            </div>
    @endguest
@endsection

    @section('scripts')
    @guest
        {{-- languageMenu.js is needed for the guest navbar on home page --}}
        <script src="{{ asset('js/customer/languageMenu.js') }}"></script>
        <script src="{{ asset('js/auth.js') }}"></script>

    @if (session('open_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalToOpen = "{{ session('open_modal') }}";
                if (modalToOpen === 'login') {
                    // Assuming your login modal has id "loginModal"
                    // and you have a function to show it, e.g., showLoginModal()
                    document.getElementById('loginModal').style.display = 'block'; // Or your specific show logic
                } else if (modalToOpen === 'signup') {
                    // Assuming signup modal id "signupModal"
                    document.getElementById('signupModal').style.display = 'block'; // Or your specific show logic

                    @if (session('failed_role') === 'owner')
                    
                    const ownerBtn = document.querySelector('.role-selector .role-btn[data-role="owner"]');
                    const customerBtn = document.querySelector('.role-selector .role-btn[data-role="customer"]');
                    if(ownerBtn && customerBtn) {
                        ownerBtn.classList.add('active');
                        customerBtn.classList.remove('active');
                        document.getElementById('custumerSignupForm').style.display = 'none';
                        document.getElementById('ownerSignupForm').style.display = 'block';
                    }
                    @endif
                }
            });
        </script>
    @endif
        </script>
    @endguest
    @auth
    
    @endauth
@endsection
