@extends('layouts.sallety')

@section('title', 'SalleTY')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/customer/listing.css') }}">
@endsection

@section('content')
<div class="container">

            <div class="path">
                <h2 class="title">Halls Listing  &gt;</h2>
            </div>

            <div class="event-filter-bar">
                <div class="filter-item same-width">
                    <i class="fas fa-location"></i>
                    <select>
                        <option disabled selected>Location</option>
                        <option>Algiers</option>
                        <option>Ouargla</option>
                        <option>Oran</option>
                    </select>
                </div>

                <div class="filter-item  same-width">
                    <i class="fas fa-champagne-glasses"></i>
                    <select>
                        <option disabled selected>Event Type</option>
                        <option>Wedding</option>
                        <option>Conferences</option>
                        <option>Birthday</option>
                        <option>Engagment</option>
                        <option>Tesdirat</option>
                        <option>Professional meetings</option>

                    </select>
                </div>

                <div class="filter-item same-width">
                    <i class="fas fa-users"></i>
                    <input type="number" placeholder="Capacity">
                </div>

                <div class="filter-item same-width">
                    <i class="fas fa-list-ul"></i>
                    <select>
                        <option disabled selected>Services</option>
                        <option>Lunch / Dinner</option>
                        <option>Photographer</option>
                        <option>DJ</option>
                    </select>
                </div>

                <div class="filter-item same-width">
                    <i class="fas fa-money-bill-wave"></i>
                    <input type="number" placeholder="Price (DA)">
                </div>

                <div class="filter-item date-range">
                    <input type="date" placeholder="From" />
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" placeholder="To" />
                </div>

                <button class="search-btn"><i class="fas fa-search"></i>
                    Search</button>
            </div>

            <div class="hall-grid">
                <!-- Hall Card 1 -->
                <div class="hall-card">
                    <div class="hall-image">
                        <img src="/Pictures/hoggar.jpg" alt="Salle El-Hoggar"
                            onclick="document.location='Hougare Halls.html'">
                    </div>
                    <div class="hall-info">
                        <h3 class="hall-name">Salle El-Hoggar</h3>
                        <p class="hall-location">Ouargla</p>
                        <p class="hall-details">Carrying capacity 50 Person</p>
                        <p class="hall-price">From 80000 DA</p>
                        <p class="discount-price">Before Discount: 85000 DA</p>
                        <button class="book-btn"
                            onclick="document.location='reservation.html'">BOOK
                            NOW</button>
                    </div>
                </div>

                <!-- Hall Card 2 -->
                <div class="hall-card">
                    <div class="hall-image">
                        <img src="/Pictures/hoggar.jpg" alt="Salle El-Hoggar">
                    </div>
                    <div class="hall-info">
                        <h3 class="hall-name">Salle El-Hoggar</h3>
                        <p class="hall-location">Ouargla</p>
                        <p class="hall-details">Carrying capacity 50 Person</p>
                        <p class="hall-price">From 80000 DA</p>
                        <p class="discount-price">Before Discount: 85000 DA</p>
                        <button class="book-btn">BOOK NOW</button>
                    </div>
                </div>

                <!-- Hall Card 3 -->
                <div class="hall-card">
                    <div class="hall-image">
                        <img src="/Pictures/hoggar.jpg" alt="Salle El-Hoggar">
                    </div>
                    <div class="hall-info">
                        <h3 class="hall-name">Salle El-Hoggar</h3>
                        <p class="hall-location">Ouargla</p>
                        <p class="hall-details">Carrying capacity 50 Person</p>
                        <p class="hall-price">From 80000 DA</p>
                        <button class="book-btn">BOOK NOW</button>
                    </div>
                </div>

            </div>
        </div>
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
                <p><a href="#">Home</a></p>
                <p><a href="#">Halls</a> <a
                        href="Hougare Halls.html">hougar</a></p>
                <p><a href="#">Why us?</a></p>
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
@endsection

@section('scripts')
        <script src="{{ asset('js/customer/newService.js') }}"></script>
@endsection
