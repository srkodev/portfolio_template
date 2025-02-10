<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? 'Portfolio - Accueil'; ?></title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Cloudflare Turnstile -->
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .fade-in {
      animation: fadeIn 0.8s ease-in forwards;
      opacity: 0;
    }
    @keyframes fadeIn {
      to { opacity: 1; }
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 overflow-x-hidden">

<!-- ASIDE: Navigation latérale -->
<aside
  id="sidebar"
  class="fixed top-0 left-0 h-full w-64 bg-[#0f2027] transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40 shadow-xl"
>
  <div class="flex flex-col h-full">
    <!-- Logo & Titre -->
    <div class="p-6 border-b border-white/20">
      <h1 class="text-2xl font-extrabold text-white">
        Alexandre<span class="text-[#00ffd9]">G</span>
      </h1>
      <p class="text-sm text-white/70">Développeur Web</p>
    </div>

    <!-- Menu principal -->
    <nav class="flex-1 px-6 py-4 space-y-3">
      <a
        href="index.php?action=home#accueil"
        class="block text-white font-semibold px-4 py-2 rounded hover:bg-[#203a43] transition"
      >
        Accueil
      </a>
      <a
        href="index.php?action=home#apropos"
        class="block text-white font-semibold px-4 py-2 rounded hover:bg-[#203a43] transition"
      >
        À propos
      </a>
      <a
        href="index.php?action=home#projets"
        class="block text-white font-semibold px-4 py-2 rounded hover:bg-[#203a43] transition"
      >
        Projets
      </a>
      <a
        href="index.php?action=home#competences"
        class="block text-white font-semibold px-4 py-2 rounded hover:bg-[#203a43] transition"
      >
        Compétences
      </a>
      <a
        href="index.php?action=home#contact"
        class="block text-white font-semibold px-4 py-2 rounded hover:bg-[#203a43] transition"
      >
        Contact
      </a>
    </nav>
  </div>
</aside>

<!-- BOUTON POUR OUVRIR / FERMER LA SIDEBAR (visible sur mobile) -->
<button
  id="menu-btn"
  class="fixed top-4 left-4 md:hidden bg-[#00ffd9] text-gray-900 p-2 rounded shadow-lg z-50 focus:outline-none"
>
  <!-- Icône Hamburger -->
  <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
  <!-- Icône Croix -->
  <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12"/>
  </svg>
</button>
