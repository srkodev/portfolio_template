<?php
$title = "admin-login";
require __DIR__ . '/../includes/header.php';
?>

    <!-- HERO SECTION ADMIN LOGIN -->
    <section
      class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-fuchsia-600 via-purple-700 to-indigo-800"
    >
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black bg-opacity-30"></div>

      <!-- Contenu Hero: Formulaire de connexion -->
      <div class="relative z-10 w-full max-w-md bg-white shadow-lg rounded-lg p-8 mx-4 fade-in">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Connexion Admin</h1>

        <!-- Affiche une erreur si existante -->
        <?php if (!empty($error)): ?>
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="post" action="index.php?action=admin_login">
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Nom d'utilisateur</label>
            <input
              type="text"
              name="username"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
              required
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Mot de passe</label>
            <input
              type="password"
              name="password"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
              required
            />
          </div>
          <button
            class="w-full bg-indigo-600 text-white font-semibold px-4 py-2 rounded-full shadow hover:bg-indigo-700 transition transform hover:-translate-y-0.5"
          >
            Se connecter
          </button>
        </form>
      </div>

      <!-- Vague décorative en bas -->
      <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
        <svg
          class="relative block w-full h-20"
          xmlns="http://www.w3.org/2000/svg"
          preserveAspectRatio="none"
          viewBox="0 0 1200 120"
        >
          <path
            d="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z"
            fill="#FFFFFF"
          />
        </svg>
      </div>
    </section>

    <!-- Script pour l’effet navbar au scroll (optionnel) -->
    <script>
      window.addEventListener("scroll", function () {
        const header = document.getElementById("header");
        if (window.scrollY > 50) {
          header.classList.add("bg-indigo-900", "bg-opacity-80", "shadow-md");
        } else {
          header.classList.remove("bg-indigo-900", "bg-opacity-80", "shadow-md");
        }
      });
    </script>
  </body>
</html>
