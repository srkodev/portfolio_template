<?php
$title = "dashboard";
require __DIR__ . '/../includes/header.php';
?>

    <!-- HERO SECTION (Dashboard) -->
    <section
      class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-fuchsia-600 via-purple-700 to-indigo-800"
    >
      <div class="absolute inset-0 bg-black bg-opacity-30"></div>
      <div class="relative z-10 text-center text-white px-4 fade-in">
        <h1 class="text-4xl sm:text-5xl font-bold mb-6 drop-shadow-lg">
          Tableau de bord Admin
        </h1>
        <p class="text-xl sm:text-2xl mb-6 drop-shadow-md">
          Gérez vos contenus, projets et compétences
        </p>
      </div>

      <!-- Wave -->
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

    <!-- SECTION D'OPTIONS ADMIN -->
    <section class="bg-white py-16 -mt-1" style="clip-path: polygon(0 0, 100% 5%, 100% 100%, 0 100%)">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-indigo-600 mb-8">Actions disponibles</h2>

        <ul class="list-disc list-inside mb-6 text-lg text-gray-700">
          <!-- Édition de "À propos" (champ textuel dans la table contents) -->
          <li>
            <a
              href="index.php?action=admin_edit_content&key=about_me"
              class="text-indigo-600 hover:underline"
              >Modifier "À propos de moi"</a
            >
          </li>
          <!-- Gestion des projets -->
          <li>
            <a
              href="index.php?action=admin_projects_list"
              class="text-indigo-600 hover:underline"
              >Gérer les projets</a
            >
          </li>
          <!-- NOUVELLE entrée : gestion des compétences en mode "cartes" -->
          <li>
            <a
              href="index.php?action=admin_competences_list"
              class="text-indigo-600 hover:underline"
            >
              Gérer les compétences
            </a>
          </li>
        </ul>

        <a
          href="index.php?action=admin_logout"
          class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition"
        >
          Se déconnecter
        </a>
      </div>
    </section>

    <?php require __DIR__ . '/../includes/footer.php';  ?>
