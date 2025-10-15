<header class="header">
    <div class="header-left">
      <div class="header-logo">🎵 Artist Info</div>
      <div class="header-slogan">alles over je muziek!</div>
    </div>

    <nav class="header-nav">
      <div class="header-hamburger" onclick="toggleMenu()" aria-label="Menu openen" role="button" tabindex="0">
        <div></div>
        <div></div>
        <div></div>
      </div>

      <div class="header-nav-links" id="navLinks">
        <a href="index.html">Home</a>
        <a href="artiesten.html">catalogus</a>
        <a href="contact.html">Contact</a>
        <a href="login.php">Login</a>
      </div>
    </nav>
  </header>
  <script>
    function toggleMenu() {
      const nav = document.getElementById('navLinks');
      nav.classList.toggle('show');
    }

    document.querySelector('.header-hamburger').addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleMenu();
      }
    });
  </script>