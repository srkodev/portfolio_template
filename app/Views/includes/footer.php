<footer class="bg-indigo-800 text-white py-8">
  <div class="max-w-7xl mx-auto px-4 text-center">
    &copy; <?= date('Y'); ?> - Portfolio Alexandre Genza. Tous droits réservés.
  </div>
</footer>
<!-- Ajout du JavaScript pour gérer le menu mobile et le smooth scroll -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Fonction pour obtenir les paramètres de requête sous forme d'objet
    function getQueryParams(url = window.location.href) {
      const params = {};
      try {
        const urlObj = new URL(url, window.location.origin);
        urlObj.searchParams.forEach((value, key) => {
          params[key] = value;
        });
      } catch (error) {
        // En cas d'URL relative ou invalide
        const queryString = url.split('?')[1] || '';
        const pairs = queryString.split('&');
        pairs.forEach(pair => {
          const [key, value] = pair.split('=');
          if (key) {
            params[decodeURIComponent(key)] = decodeURIComponent(value || '');
          }
        });
      }
      return params;
    }

    // Récupère les paramètres de requête de la page actuelle
    const currentParams = getQueryParams();
    const isHomePage = currentParams['action'] === 'home';

    // Sélectionne tous les liens contenant 'action=home#'
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

          // Fermer le menu mobile après sélection
          const mobileMenu = document.getElementById('mobile-menu');
          const hamburgerIcon = document.getElementById('hamburger-icon');
          const closeIcon = document.getElementById('close-icon');

          if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            if (hamburgerIcon && closeIcon) {
              hamburgerIcon.classList.remove('hidden');
              closeIcon.classList.add('hidden');
            }
          }

          // Mettre à jour l'URL hash sans défiler
          history.pushState(null, null, hash);
        }
        // Sinon, laisser le comportement par défaut (navigation normale)
      });
    });

    // Gestion du bouton menu mobile
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuButton) {
      mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        // Basculer les icônes
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
      });
    }

    // Fermer le menu mobile lorsqu'on clique sur un lien du menu
    const mobileLinks = mobileMenu.querySelectorAll('a[href*="action=home#"]');
    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (!mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
          hamburgerIcon.classList.remove('hidden');
          closeIcon.classList.add('hidden');
        }
      });
    });

    // Changer le background du header au scroll
    window.addEventListener('scroll', () => {
      const header = document.getElementById('header');
      if (window.scrollY > 50) {
        header.classList.remove('bg-transparent');
        header.classList.add('bg-indigo-800', 'bg-opacity-90', 'shadow-lg');
      } else {
        header.classList.add('bg-transparent');
        header.classList.remove('bg-indigo-800', 'bg-opacity-90', 'shadow-lg');
      }
    });
  });
</script>
