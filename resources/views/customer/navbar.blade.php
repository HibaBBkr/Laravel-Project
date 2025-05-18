<header class="pro-header">
    <nav>
    <div class="logo">
      <img src="{{ asset('pictures/logo.png') }}" alt="EventHalls Logo" height="70" />
    </div>
    <ul class="nav-links">
      <li><a href="{{ route('Home') }}">Home</a></li>
      <li><a href="#">Halls</a></li>
      <li><a href="#">Why us?</a></li>
      <li><a>
        <div class="language-menu">
          <img src="https://cdn-icons-png.flaticon.com/512/44/44386.png" alt="Globe" class="globe-icon" onclick="toggleLangMenu()">
          <div class="lang-options" id="langOptions">
            <div onclick="setLang('en')">EN</div>
            <div onclick="setLang('fr')">FR</div>
            <div onclick="setLang('ar')">AR</div>
          </div>
        </div>        
      </a></li>
      <div class="user-menu-container">
        <button type="button" class="user-menu-trigger" aria-haspopup="true" aria-expanded="false" onclick="toggleUserMenu()">
          <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) . '?' . time() : asset('pictures/default_profile.jpg') }}" alt="User Avatar" class="user-avatar">          <i class="fas fa-caret-down user-caret"></i>
        </button>

        <div class="profile-dropdown" id="userMenu" role="menu" >
          <ul role="none">
            <li role="menuitem"><a href="mybooking.html">Bookings</a></li>
            <li role="menuitem"><a href="{{ route('profile.show') }}">Profil</a></li>
            <li role="separator"></li>
            <li role="menuitem"><a href="#">Help</a></li>
            <li role="menuitem"><form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Log out
                    </a>
                </form>
            </li>
          </ul>
        </div>
      </div>

    </ul>
    </nav>
    </header>