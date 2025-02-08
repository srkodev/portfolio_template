<?php
$title = "Projet_détail";
require __DIR__ . '/../includes/header.php';
?>

    <!-- HERO DU PROJET -->
    <section
      class="relative flex items-center justify-center min-h-[50vh] bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-700"
    >
      <div class="absolute inset-0 bg-black bg-opacity-30"></div>

      <!-- Contenu du Hero -->
      <div class="relative z-10 text-center text-white px-4 fade-in">
        <!-- Titre du projet (dynamique) -->
        <h1 class="text-4xl sm:text-5xl font-bold mb-4 drop-shadow-lg">
          <?= htmlspecialchars($project['title'] ?? 'Détail du Projet') ?>
        </h1>
        <p class="text-xl sm:text-2xl drop-shadow-md">
          <!-- Sous-titre ou phrase d'accroche -->
          <?= $project['subtitle'] ?? 'Une brève phrase qui résume ce projet' ?>
        </p>
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

    <!-- SECTION DESCRIPTION PROJET -->
    <section class="bg-white py-16">
      <div class="max-w-5xl mx-auto px-4 fade-in">
        <h2 class="text-3xl sm:text-4xl font-bold text-indigo-600 mb-8">
          Présentation du Projet
        </h2>
        <p class="text-gray-700 text-lg leading-relaxed mb-6">
          <?= nl2br(htmlspecialchars($project['presentation'] ?? 'Description non disponible.')); ?>
        </p>


        <!-- Galerie d'Images (optionnelle) -->
        <?php if (!empty($project['gallery'])): ?>
          <h3 class="text-2xl font-semibold text-indigo-600 mb-4">
            Galerie d'Images
          </h3>
          <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
            <?php foreach ($project['gallery'] as $img): ?>
              <div class="relative">
                <img
                  src="<?= htmlspecialchars($img['src']) ?>"
                  alt="<?= htmlspecialchars($img['alt']) ?>"
                  class="w-full h-48 object-cover rounded-lg shadow-md cursor-pointer"
                  onclick="openModal('<?= htmlspecialchars($img['src']) ?>', '<?= htmlspecialchars($img['alt']) ?>')"
                />
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Modal -->
          <div id="myModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="imgModal">
            <div id="caption" class="text-center text-white mt-4"></div>
          </div>
        <?php endif; ?>

        <h3 class="text-2xl font-semibold text-indigo-600 mt-12 mb-4">
          Technologies &amp; Méthodologie
        </h3>
        <p class="text-gray-700 text-lg leading-relaxed mb-6">
          <!-- Exemple ou utilisation dynamique -->
          <?= nl2br(htmlspecialchars($project['techno'] ?? 'Liste des technos, frameworks...')) ?>
        </p>

        <!-- Bouton de retour -->
        <div class="mt-8">
          <a
            href="index.php?action=home#apropos"
            class="inline-block bg-indigo-600 text-white font-semibold px-8 py-3 rounded-full shadow hover:bg-indigo-700 transition transform hover:-translate-y-0.5"
          >
            Revenir aux projets
          </a>
        </div>
      </div>
    </section>

    <?php require __DIR__ . '/../includes/footer.php';  ?>