<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? 'Portfolio - Accueil'; ?></title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Cloudflare Turnstile via CDN -->
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    /* Animation d'apparition légère */
    .fade-in {
      animation: fadeIn 1s ease-in forwards;
      opacity: 0;
    }
    @keyframes fadeIn {
      to { opacity: 1; }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased overflow-x-hidden">

  <!-- HEADER (transparent, se colore au scroll) -->
  <header
    class="fixed w-full z-30 transition-all duration-300 ease-in-out bg-transparent"
    id="header"
  >
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
      <!-- Logo -->
      <div class="text-xl font-bold text-white drop-shadow-lg">
        Alexandre<span class="text-indigo-200"> Genza</span>
      </div>
      <!-- Menu Desktop -->
      <nav class="space-x-4 hidden md:block">
        <a href="index.php?action=home#accueil" class="text-white hover:text-indigo-200 font-medium transition">Accueil</a>
        <a href="index.php?action=home#apropos" class="text-white hover:text-indigo-200 font-medium transition">À propos</a>
        <a href="index.php?action=home#projets" class="text-white hover:text-indigo-200 font-medium transition">Projets</a>
        <a href="index.php?action=home#competences" class="text-white hover:text-indigo-200 font-medium transition">Compétences</a>
        <a href="index.php?action=home#contact" class="text-white hover:text-indigo-200 font-medium transition">Contact</a>
      </nav>
      <!-- Bouton Menu Mobile -->
      <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none focus:ring-2 focus:ring-indigo-600 rounded" aria-label="Menu">
        <!-- Icon Hamburger par défaut -->
        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- Icon Croix caché par défaut -->
        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <!-- Menu Mobile -->
    <nav id="mobile-menu" class="md:hidden bg-white/30 backdrop-blur-sm text-center text-white hidden">
      <a href="index.php?action=home#accueil" class="block px-4 py-2 hover:bg-indigo-700">Accueil</a>
      <a href="index.php?action=home#apropos" class="block px-4 py-2 hover:bg-indigo-700">À propos</a>
      <a href="index.php?action=home#projets" class="block px-4 py-2 hover:bg-indigo-700">Projets</a>
      <a href="index.php?action=home#competences" class="block px-4 py-2 hover:bg-indigo-700">Compétences</a>
      <a href="index.php?action=home#contact" class="block px-4 py-2 hover:bg-indigo-700">Contact</a>
    </nav>
  </header>
