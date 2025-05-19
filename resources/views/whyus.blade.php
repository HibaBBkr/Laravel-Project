@extends('layouts.sallety')

@section('title', SalleTY')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/whyus.css') }}">
@endsection

@section('content')
<div class="main">
  <div class="main-header">
    <h2>With <span>SalleTY</span></h2>
    <p>
      You can plan all your events and meetings successfully and create the most beautiful memories to last a long time.<br>
      We improve the visibility of places and halls by using the latest marketing services.<br>
      All options and more in one place... Through EventHalls, you can view all options, browse them, compare their features, and then choose the place that best suits your specific needs.
    </p>
  </div>
  
  <div class="gallery">
    <img src="/Pictures/hoggar1.jpg" alt="Hall 1">
    <img src="/Pictures/hoggar4.jpg" alt="Hall 2">
    <img src="/Pictures/hoggar7.jpg" alt="Hall 3">
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
    <p><a href="Home.html">Home</a></p>
    <p><a href="HallListing.html">Halls</a></p>
    <p><a href="whyus.html">Why us?</a></p>
    <p><a href="#">Terms and conditions</a></p>
    <p><a href="#">Privacy Policy</a></p>
  </div>
  <div>
    <h4>Contact us</h4>
    <p>Ouargla, Algeria</p>
    <p><a href="mailto:info@eventhall.com.dz">info@eventhall.com.dz</a></p>
    <p>+2135******75</p>
  </div>
</footer>

@endsection

@section('scripts')
        <script src="{{ asset('js/customer/newService.js') }}"></script>
@endsection
