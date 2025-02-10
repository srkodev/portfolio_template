<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portfolio - Jules Crevoisier, Développeur Web</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap" rel="stylesheet" />
 <!-- Captcha cloudflare -->
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- AOS CSS (pour les animations) -->
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <!-- Configuration personnalisée de Tailwind avec darkMode activé -->
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { sans: ['Archivo', 'sans-serif'] },
          colors: {
            accent: '#ffa51f',
            lightCard: 'rgba(255, 255, 255, 0.9)',
            darkCard: 'rgba(31, 41, 55, 0.9)'
          }
        }
      }
    }
  </script>
  <!-- Styles personnalisés -->
  <style>
    /* Activation du défilement fluide pour toute la page */
    html {
      scroll-behavior: smooth;
    }

    /* Corps de page : clair par défaut, sombre en .dark */
    body {
      font-family: 'Archivo', sans-serif;
      overflow-x: hidden;
    }

    /* Liens de navigation */
    .header-nav-item {
      color: rgba(0, 0, 0, 0.7);
      transition: color 0.4s ease;
    }
    .header-nav-item:hover {
      color: rgba(0, 0, 0, 0.9);
    }
    .dark .header-nav-item {
      color: rgba(255, 255, 255, 0.7);
    }
    .dark .header-nav-item:hover {
      color: rgba(255, 255, 255, 0.9);
    }
  </style>
</head>
<body class="bg-white text-black dark:bg-gray-900 dark:text-white relative">
  <!-- Fond dynamique via tsParticles -->
  <div id="tsparticles" class="absolute top-0 left-0 w-full h-full -z-10"></div>

  <!-- HEADER -->
  <header class="container mx-auto px-4 py-6">
    <div class="flex items-center">
      <!-- Logo / Nom, à gauche -->
      <div class="flex items-center space-x-2">
        <span class="text-3xl font-bold">Jules Crevoisier</span>
        <span class="text-xl opacity-70">, Développeur Web</span>
      </div>
      
      <!-- Navigation + Switch, à droite -->
      <div class="ml-auto flex items-center space-x-36">
        <nav class="hidden md:flex space-x-8">
          <a href="index.php?action=home#present" class="header-nav-item">Accueil</a>
          <a href="index.php?action=home#projects" class="header-nav-item">Projets</a>
          <a href="index.php?action=home#skills" class="header-nav-item">Compétences</a>
          <a href="index.php?action=home#contact" class="header-nav-item">Contact</a>
        </nav>
        <!-- Bouton switch Light/Dark rond -->
        <button id="theme-toggle"
                class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 
                       bg-gray-100 text-gray-700 hover:bg-gray-200 
                       dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 
                       transition focus:outline-none">
          <!-- Icône Lune (pour passer en dark) -->
          <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 116.707 2.707 8.001 8.001 0 0017.293 13.293z"></path>
          </svg>
          <!-- Icône Soleil (pour repasser en clair) -->
          <svg id="theme-toggle-light-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 15a5 5 0 100-10 5 5 0 000 10z"></path>
            <path d="M10 1v2M10 17v2M4.22 4.22l1.42 1.42M14.36 14.36l1.42 1.42M1 10h2M17 10h2M4.22 15.78l1.42-1.42M14.36 5.64l1.42-1.42"></path>
          </svg>
        </button>
      </div>
    </div>
  </header>
