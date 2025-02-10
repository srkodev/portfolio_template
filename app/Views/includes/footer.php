<footer class="text-center py-6 mt-10 bg-[#203a43] text-white">
  <div class="max-w-7xl mx-auto px-4">
    &copy; <?= date('Y'); ?> - Portfolio Alexandre Genza. Tous droits réservés.
  </div>
</footer>

<!-- Scripts -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Gestion de la Sidebar sur mobile
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menu-btn');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    menuBtn.addEventListener('click', () => {
      if (sidebar.classList.contains('-translate-x-full')) {
        // Ouvrir
        sidebar.classList.remove('-translate-x-full');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
      } else {
        // Fermer
        sidebar.classList.add('-translate-x-full');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
      }
    });

    // Smooth scroll sur la page d'accueil
    function getQueryParams(url = window.location.href) {
      const params = {};
      try {
        const urlObj = new URL(url, window.location.origin);
        urlObj.searchParams.forEach((value, key) => {
          params[key] = value;
        });
      } catch (error) {
        const queryString = url.split('?')[1] || '';
        const pairs = queryString.split('&');
        pairs.forEach(pair => {
          const [k, v] = pair.split('=');
          if (k) {
            params[decodeURIComponent(k)] = decodeURIComponent(v || '');
          }
        });
      }
      return params;
    }

    const currentParams = getQueryParams();
    const isHomePage = (currentParams['action'] === 'home' || !currentParams['action']);

    document.querySelectorAll('a[href*="action=home#"]').forEach((link) => {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        const url = new URL(href, window.location.origin);
        const linkAction = url.searchParams.get('action');
        const hash = url.hash;
        
        if (isHomePage && linkAction === 'home' && hash) {
          e.preventDefault();
          const targetElement = document.querySelector(hash);
          if (targetElement) {
            targetElement.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
          // Fermer la sidebar si ouverte
          if (!sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            hamburgerIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
          }
          // Mettre à jour l’URL (ancre)
          history.pushState(null, null, hash);
        }
      });
    });
  });
</script>

</body>
</html>
