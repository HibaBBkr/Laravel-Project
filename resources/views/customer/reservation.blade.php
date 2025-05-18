@extends('layouts.sallety')

@section('title', 'SalleTY')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/customer/reserve_pay.css') }}">
@endsection

@section('content')

<div class="main-contain">
    <div class="path">
      <h2 class="title">Booking Details  &gt;</h2>
    </div>
      <div class="res-container">
          <div class="left">
          <h2>Request to Book</h2>
            <p>Fill in the details below to request a booking for your event.</p>
          <label for="event-type">Event Type</label>
          <select id="event-type">
            <option>Professional meeting</option>
            <option>Wedding</option>
            <option>Birthday Party</option>
          </select>
    
          <label for="date">Time and Date</label>
          <div class="time-inputs">
            <input type="date" value="2025-02-23">
            <input type="date" value="2025-02-25">
          </div>
          <div class="time-inputs">
            <input type="time" value="09:00">
            <input type="time" value="16:30">
          </div>
    
          <label for="invitees">Expected Number of Invitees</label>
          <input type="text" id="invitees" value="">
    
          <label>Additional Services Available</label>
          <div class="services">
            <div class="service-item"><input type="checkbox"> Cakes</div>
            <div class="service-item"><input type="checkbox" checked> Lunch/person</div>
            <div class="service-item"><input type="checkbox" checked> Coffee Break/person</div>
            <div class="service-item"><input type="checkbox"> Dinner/person</div>
            <div class="service-item"><input type="checkbox"> DJ El-wahat</div>
            <div class="service-item"><input type="checkbox"> Photographer</div>
          </div>
        </div>
    
        <div class="right">
          <img src="/Pictures/hoggar.jpg" alt="Salle El-Hoggar">
          <div class="details">
            <h3>Salle El-Hoggar</h3>
            <div class="address">📍 Ave El Kods, Ouargla , Algeria</div>
            <div class="attendees">👥 Attendees: 240 People</div>
            <div class="rating">⭐⭐⭐⭐☆</div>
    
            <hr>
    
            <div>Date and Time<br>
            Sun, Fev 23 ,2025 --- Tue, Fev 25 ,2025<br>
            09:00 AM --- 16:30 PM</div>
    
            <hr>
    
            <div class="rental-info">
              <table>
                <tr><td>Hall rental</td><td>850,000 DA</td></tr>
                <tr><td>Lunch/person</td><td>2,500 DA</td></tr>
                <tr><td>Coffee Break/person</td><td>2,000 DA</td></tr>
              </table>
              <div class="total">Total: 875,500 DA</div>
            </div>
    
            <button class="submit-btn" onclick="document.location='success.html'"> Send request</button>
          </div>
        </div>
      </div>
  </div>

@endsection

