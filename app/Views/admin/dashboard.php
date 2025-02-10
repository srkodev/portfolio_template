<?php
$title = "dashboard";
require __DIR__ . '/../includes/header.php';
?>

<!-- SECTION (TABLEAU DE BORD) -->
<section 
  class="relative flex items-center justify-center min-h-[40vh]" 
  data-aos="fade-up"
>
  <div class="relative z-10 text-center px-4 fade-in">
    <!-- Texte en blanc -->
    <h1 class="text-4xl sm:text-5xl font-bold mb-6 text-white">
      Tableau de bord Admin
    </h1>
    <p class="text-xl sm:text-2xl mb-6 text-white">
      Gérez vos contenus, projets et compétences
    </p>
  </div>
</section>

<!-- SECTION ACTIONS ADMIN -->
<section class="py-16" data-aos="fade-up">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-indigo-600 mb-8">Actions disponibles</h2>

    <ul class="list-disc list-inside mb-6 text-lg">
      <!-- Édition de "À propos" -->
      <li>
        <a
          href="index.php?action=admin_edit_content&key=about_me"
          class="text-indigo-600 hover:underline"
        >
          Modifier "À propos de moi"
        </a>
      </li>
      <!-- Gestion des projets -->
      <li>
        <a
          href="index.php?action=admin_projects_list"
          class="text-indigo-600 hover:underline"
        >
          Gérer les projets
        </a>
      </li>
      <!-- Gestion des compétences -->
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
      class="inline-block bg-red-600 text-white px-4 py-2 rounded 
             hover:bg-red-700 transition"
    >
      Se déconnecter
    </a>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
