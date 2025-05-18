@extends('layouts.sallety')

@section('title', SalleTY')

@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/owner/addhall.css') }}">
@endsection

@section('content')
<main class="content-area">
        <div class="container">
            <div class="path">
                <h2 class="title">Add Your Hall  &gt;</h2>
            </div>
            <h1 class="main-heading">Enter Your Hall Information</h1>
            <p class="sub-heading">  You must fill in the following fields </p>

            <form action="addHall" method="post" class="add-hall-form">

                <div class="form-section two-column-section">
                    <!-- Left Column: Hall Info -->
                    <div class="form-column hall-info-column">
                        <h2 class="section-heading"><i class="fa-solid fa-circle-info icon-bullet"></i> Hall Information</h2>

                        <div class="form-group">
                            <label for="hall-name">Hall Name</label>
                            <input type="text" id="hall-name" name="hallName">
                        </div>

                        <div class="form-group">
                            <label for="hall-description">Hall Description</label>
                            <textarea id="hall-description" name="hallDescription" rows="4"></textarea>
                        </div>

                        <div class="row-group">
                            <div class="form-group">
                                <label for="wilaya">Wilaya</label>
                                <select type="text" id="wilaya" name="States">
                                    <option value="">Ouargla</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <select type="text" id="city" name="Cities">
                                    <option value="">Ouargla</option>
                                    <option value="">Angoussa</option>
                                <option value="">Hassi Messoud</option>
                                <option value="">Sidi Khouiled</option>
                                <option value="">Ein El-Baida</option>
                                <option value="">Hassi Ben Abdellah</option>
                                <option value="">El-Berma</option>
                                <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" id="capacity" name="capacity">
                        </div>

                        <div class="form-group">
                            <label for="base-price">Base Booking Price</label>
                            <input type="text" id="base-price" name="basePrice">
                        </div>

                         <div class="form-group icon-input-group">
                            <label for="map-url">URL in Map</label>
                            <input type="text" id="map-url" name="mapUrl">
                        </div>
                    </div>

                    <div class="form-column upload-pictures-column">
                        <h2 class="section-heading">Upload Pictures of Your Hall</h2>
                        <div class="picture-previews"></div>
                             
                        <div class="upload-area">
                             <input type="file" id="hall-pictures" name="hallPictures[]" multiple accept="image/*" style="display: none;">
                             <label for="hall-pictures" class="button button-secondary">Upload</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                     <h2 class="section-heading">Hall Type <span class="sub-text">(the events you host)</span></h2>
                     <div class="checkbox-group">
                     
                     <div class="checkbox-option">
                         <input type="checkbox" id="type-engagement" name="hallType[]" value="engagement"> 
                         <label for="type-engagement">Engagement</label>
                     </div>
                     <div class="checkbox-option">
                         <input type="checkbox" id="type-birthbay" name="hallType[]" value="birthday">
                         <label for="type-birthday">Birthday</label>
                     </div>
                     <div class="checkbox-option"> 
                          <input type="checkbox" id="type-wedding" name="hallType[]" value="wedding">
                         <label for="type-wedding">Wedding</label>
                     </div>
                     <div class="checkbox-option">
                         <input type="checkbox" id="type-lunch-dinner" name="hallType[]" value="lunch-dinner">
                         <label for="type-lunch-dinner">Lunch \ Dinner</label>
                     </div>
                     <div class="checkbox-option"> 
                         <input type="checkbox" id="type-conference" name="hallType[]" value="conference"> 
                         <label for="type-conference">Conference</label>
                     </div>
                     <div class="checkbox-option">
                         <input type="checkbox" id="type-meeting" name="hallType[]" value="meeting"> 
                         <label for="type-meeting">Professional meeting</label>
                     </div>
                     <div class="checkbox-option"> 
                          <input type="checkbox" id="type-training" name="hallType[]" value="training"> 
                         <label for="type-training">Training course</label>
                     </div>
                 </div>
                </div>

                <div class="form-section services-section">
                <h2 class="section-heading">Available Services</h2>

                <div class="services-grid-header">
                    <div class="header-item service-col">Services name</div>
                    <div class="header-item description-col">Description</div>
                    <div class="header-item price-col">Price</div>
                    <div class="header-item pricing-type-col"></div>
                    <div class="header-item upload-col"></div>
                    <div class="header-item file-name-col"></div>
                    <div class="header-item delete-col"></div> 
                </div>

                <div class="services-grid-rows">
                    <div class="services-grid-row">
                    <div class="grid-cell service-col">
                        <input type="text" name="service_name[]" value="">
                    </div>
                    <div class="grid-cell description-col">
                        <input type="text" name="service_description[]" value="">
                    </div>
                    <div class="grid-cell price-col">
                        <input type="text" name="service_price[]" value=""><span>DA</span>
                    </div>
                    <div class="grid-cell pricing-type-col radio-group-inline">
                        <input type="radio" id="price_type_fixed_1" name="service_price_type_1" value="fixed" checked>
                        <label for="price_type_fixed_1">Fixed</label>
                        <input type="radio" id="price_type_person_1" name="service_price_type_1" value="person">
                        <label for="price_type_person_1">Per person</label>
                    </div>
                    <div class="grid-cell upload-col">
                        <input type="file" id="service_pic_1" name="service_pic[]" accept="image/*" hidden>
                        <label for="service_pic_1" class="button button-secondary">Upload Picture</label>
                    </div>
                    <div class="grid-cell file-name-col">no file chosen</div>
                    <div class="grid-cell delete-col">
                        <button type="button" class="delete-service-button"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                    </div>
                    <!-- بقية الصفوف... -->
                </div>
                    <!-- Add New Service Button -->
                    <button type="button" class="add-service-button"><i class="fas fa-plus-circle"></i> Add a new service</button>
                </div>

                <div class="form-section">
                     <h2 class="section-heading">Hall Host Rules :</h2>
                     <div class="form-group">
                        <textarea id="host-rules" name="hostRules" rows="5" placeholder="Write your rules ....."></textarea>
                     </div>
                </div>

                <div class="form-section">
                    <h2 class="section-heading"><i class="fa-solid fa-circle-info icon-bullet"></i> Host Information</h2>

                    <div class="form-group">
                        <label for="host-name">Host Name</label>
                        <input type="text" id="host-name" name="hostName">
                    </div>

                    <div class="form-group">
                        <label for="host-email">E-mail</label>
                        <input type="email" id="host-email" name="hostEmail">
                    </div>

                    <div class="form-group ">
                        <label for="host-phone">Phone number</label>
                        <input type="tel" id="host-phone" name="hostPhone" placeholder="+213 *********">
                    </div>

                     <div class="form-group">
                        <label for="host-rip">Postal Identity Statement (RIP)</label>
                        <input type="text" id="host-rip" name="hostRip">
                    </div>

                     <div class="form-group">
                        <label for="cardholder-name">Cardholder Name</label>
                        <input type="text" id="cardholder-name" name="cardholderName">
                    </div>

                     <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" name="cardNumber" placeholder="1234 1234 1234 1234">
                    </div>

                     <div class="row-group">
                         <div class="form-group">
                            <label for="expiry-date">Expiration Date</label>
                            <input type="text" id="expiry-date" name="expiryDate" placeholder="MM/YY">
                         </div>
                          <div class="form-group">
                            <label for="security-code">Security code</label>
                            <input type="text" id="security-code" name="securityCode" placeholder="CVC">
                         </div>
                    </div>
                </div>

                <div class="form-section terms-section">
                     <input type="checkbox" id="terms" name="termsAccepted" value="yes">
                     <label for="terms">I understood and accepted the <a href="#" target="_blank">Terms and Conditions</a></label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button button-primary">Send request</button>
                </div>

            </form>
        </div>
    </main>
@endsection

@section('scripts')
        <script src="{{ asset('js/customer/newService.js') }}"></script>
@endsection
