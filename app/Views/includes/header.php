<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <title><?= $title ?? 'Portfolio - Accueil'; ?></title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
    <!-- cloudflare via CDN -->
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
      <div class="text-xl font-bold text-white drop-shadow-lg">
        Jules<span class="text-indigo-200">Crevoisier</span>
      </div>
      <nav class="space-x-4 hidden md:block">
        <a href="index.php?action=home#accueil" class="text-white hover:text-indigo-200 font-medium transition">Accueil</a>
        <a href="index.php?action=home#apropos" class="text-white hover:text-indigo-200 font-medium transition">À propos</a>
        <a href="index.php?action=home#projets" class="text-white hover:text-indigo-200 font-medium transition">Projets</a>
        <a href="index.php?action=home#competences" class="text-white hover:text-indigo-200 font-medium transition">Compétences</a>
        <a href="index.php?action=home#contact" class="text-white hover:text-indigo-200 font-medium transition">Contact</a>
      </nav>
    </div>
  </header>
