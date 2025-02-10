  <!-- FOOTER -->
  <footer class="container mx-auto px-4 py-8 text-center text-gray-600 dark:text-gray-400">
    &copy; 2025 Jules Crevoisier. Tous droits réservés.
  </footer>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out'
    });
  </script>

  <!-- tsParticles (fond transparent pour voir le switch de couleur) -->
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
  <script>
    tsParticles.load("tsparticles", {
      background: { color: { value: "transparent" } },
      particles: {
        number: { value: 120, density: { enable: true, value_area: 800 } },
        color: { value: "#666666" },
        shape: { type: "circle" },
        opacity: { value: 0.8, random: true },
        size: { value: 2, random: true },
        move: { enable: true, speed: 0.3, direction: "none", out_mode: "out" },
        line_linked: { enable: false }
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: { enable: true, mode: "repulse" },
          onclick: { enable: true, mode: "push" },
          resize: true
        },
        modes: {
          repulse: { distance: 150, duration: 0.4 },
          push: { particles_nb: 4 }
        }
      },
      retina_detect: true
    });
  </script>

  <!-- Script du switch Light/Dark -->
  <script>
    const themeToggle = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    // Vérification du mode actuel via localStorage ou media-query
    if (localStorage.getItem('theme') === 'dark'
      || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
      darkIcon.classList.remove('hidden');  // Icône lune affichée
      lightIcon.classList.add('hidden');    // Icône soleil masquée
    } else {
      document.documentElement.classList.remove('dark');
      darkIcon.classList.add('hidden');
      lightIcon.classList.remove('hidden');
    }

    themeToggle.addEventListener('click', () => {
      // Bascule la classe "dark" sur la racine HTML
      if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        darkIcon.classList.add('hidden');
        lightIcon.classList.remove('hidden');
      } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
