     //----- language menu [globel icon]
    function toggleLangMenu() {
        const menu = document.getElementById('langOptions');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
    function setLang(lang) {
        alert("Language switched to: " + lang); // Replace this with actual language change logic
        document.getElementById('langOptions').style.display = 'none';
  }    
    // Optional: close menu if clicked outside
    document.addEventListener('click', function(event) {
        const langMenu = document.querySelector('.language-menu');
        const langOptions = document.getElementById('langOptions');
        if (langMenu && langOptions && !langMenu.contains(event.target)) {
            langOptions.style.display = 'none';
        }
    });


    function toggleUserMenu() {
        const menu = document.getElementById('userMenu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.profile-dropdown');
        const UMO = document.getElementById('userMenu');
        if (UMO && langOptions && !langMenu.contains(event.target)) {
            UMO.style.display = 'none';
        }
    });