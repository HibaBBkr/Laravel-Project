<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'SalleTY')</title>
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> 
  @yield('stylesheets') 
</head>
<body>

@auth
    @if (Auth::user()->role === 'owner')
        @include('owner.navbar') {{-- Assuming you have resources/views/owner/navbar.blade.php --}}
    @elseif (Auth::user()->role === 'customer')
        @include('customer.navbar') {{-- This is your existing one --}}
    @else
        {{-- Optional: A default navbar for authenticated users with other roles, or no role --}}
        {{-- @include('default.navbar') --}}
    @endif
@endauth

    <div>
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>  
    <script src="{{ asset('js/changeProfilePhoto.js') }}"></script>
    <script src="{{ asset('js/languageMenu.js') }}"></script>
    
    @yield('scripts')

</body>
</html>
