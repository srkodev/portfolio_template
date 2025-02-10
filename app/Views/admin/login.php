<?php
$title = "admin-login";
require __DIR__ . '/../includes/header.php';
?>

<!-- SECTION ADMIN LOGIN -->
<section 
  class="relative flex items-center justify-center min-h-screen" 
  data-aos="fade-up"
>
  <!-- Formulaire de connexion -->
  <div class="relative z-10 w-full max-w-md shadow-lg rounded-lg p-8 mx-4 fade-in 
              bg-white dark:bg-gray-800">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center">
      Connexion Admin
    </h1>

    <!-- Affiche une erreur si existante -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="post" action="index.php?action=admin_login">
      <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">
          Nom d'utilisateur
        </label>
        <input
          type="text"
          name="username"
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 
                 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100"
          required
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">
          Mot de passe
        </label>
        <input
          type="password"
          name="password"
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 
                 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500
                 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100"
          required
        />
      </div>
      <button
        class="w-full bg-indigo-600 text-white font-semibold px-4 py-2 rounded-full shadow 
               hover:bg-indigo-700 transition transform hover:-translate-y-0.5"
      >
        Se connecter
      </button>
    </form>
  </div>
</section>

<!-- (Optionnel) Script pour changer la navbar au scroll, si vous en avez besoin -->
<script>
  window.addEventListener("scroll", function () {
    const header = document.getElementById("header");
    if (!header) return;
    if (window.scrollY > 50) {
      header.classList.add("bg-indigo-900", "bg-opacity-80", "shadow-md");
    } else {
      header.classList.remove("bg-indigo-900", "bg-opacity-80", "shadow-md");
    }
  });
</script>

<?php
require __DIR__ . '/../includes/footer.php';
?>
