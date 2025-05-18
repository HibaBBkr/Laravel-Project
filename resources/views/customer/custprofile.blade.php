@extends('layouts.sallety')

@section('title', 'Account')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<main class="account-container">
    <div class="path">
      <h2 class="title">Account</h2>
      <button class="path-btn" type="submit" form="profileForm">Save</button>
    </div>

    <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    
    <section class="form-section">
      <div class="profile-section">
        <div class="profile-img">
          <img id="profilePhotoDisplay" src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('pictures/default_profile.jpg') }}" alt="Profile Photo">
          <span id="changeProfilePhotoBtn" class="camera-icon"><i class="fa-solid fa-camera" style="color: #ffffff;"></i></span>
          <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*" style="display:none;">
        </div>
        <h3><strong>{{ $user->name }}</strong></h3>
      </div>

    <h4>• Basic Information</h4>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">        
      </div>
      <div class="form-group full-width">
        <label>E-mail</label>
        <div class="input-icon">
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
        </div>
      </div>

      <div class="form-group full-width">
        <label>Phone number</label>
        <div class="input-icon">
        <input type="tel" name="phone_number" placeholder="+213 ********" value="{{ old('phone_number', $user->phone_number) }}">
        </div>
      </div>
        <div class="card">
          <h4>• Notifications</h4>
          <p>
            Send me exclusive deals, inspiration, news, and community updates via email.
            <input type="checkbox" name="receive_notifications" value="1" {{ $user->receive_notifications ? 'checked' : '' }}>
          </p>
        </div>
      </section>
    </form>
</main>
@endsection