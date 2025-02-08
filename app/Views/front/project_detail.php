<?php
$title = "Projet_détail";
require __DIR__ . '/../includes/header.php';
?>

<?php if (!empty($project['gallery'])): ?>
  <!-- Modal placé immédiatement après le header pour s'assurer qu'il est au-dessus de tout autre contenu -->
  <div id="myModal" class="fixed inset-0 hidden flex items-center justify-center bg-black bg-opacity-80 z-50">
    <div class="relative max-w-3xl w-full mx-4">
      <!-- Bouton de fermeture -->
      <button
        class="absolute top-4 right-4 text-white text-3xl font-bold focus:outline-none z-10"
        onclick="closeModal()"
        aria-label="Fermer le modal"
      >
        &times;
      </button>
      
      <!-- Bouton Précédent -->
      <button
        class="absolute top-1/2 left-0 transform -translate-y-1/2 -translate-x-full text-white text-3xl font-bold focus:outline-none z-10"
        onclick="prevImage()"
        aria-label="Image précédente"
      >
        &#10094;
      </button>
      
      <!-- Bouton Suivant -->
      <button
        class="absolute top-1/2 right-0 transform -translate-y-1/2 translate-x-full text-white text-3xl font-bold focus:outline-none z-10"
        onclick="nextImage()"
        aria-label="Image suivante"
      >
        &#10095;
      </button>
      
      <!-- Image Agrandie -->
      <img id="imgModal" class="w-full h-auto max-h-[80vh] rounded-lg shadow-lg object-contain" alt="Image Agrandie">
      
      <!-- Légende -->
      <p id="caption" class="mt-4 text-center text-white text-lg"></p>
    </div>
  </div>
<?php endif; ?>

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
        <?php foreach ($project['gallery'] as $index => $img): ?>
          <div class="relative">
            <img
              src="<?= htmlspecialchars($img['src']) ?>"
              alt="<?= htmlspecialchars($img['alt']) ?>"
              class="w-full h-48 object-cover rounded-lg shadow-md cursor-pointer transform hover:scale-105 transition duration-300 gallery-image"
              onclick="openModalWithIndex(<?= $index ?>)"
              data-index="<?= $index ?>"
            />
          </div>
        <?php endforeach; ?>
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

<!-- Ajout du JavaScript pour gérer le modal -->
<script>
  let currentImageIndex = 0;
  let galleryImages = [];

  <?php if (!empty($project['gallery'])): ?>
    galleryImages = <?= json_encode(array_map(function($img) {
      return [
        'src' => $img['src'], // Utiliser les chemins d'origine sans htmlspecialchars
        'alt' => htmlspecialchars($img['alt']) // Garder htmlspecialchars pour les légendes
      ];
    }, $project['gallery'])) ?>;
  <?php endif; ?>

  // Fonction pour ouvrir le modal avec l'index de l'image
  function openModalWithIndex(index) {
    currentImageIndex = index;
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("imgModal");
    const captionText = document.getElementById("caption");

    modalImg.src = galleryImages[index].src;
    modalImg.alt = galleryImages[index].alt;
    captionText.textContent = galleryImages[index].alt;

    modal.classList.remove("hidden");
  }

  // Fonction pour fermer le modal
  function closeModal() {
    const modal = document.getElementById("myModal");
    modal.classList.add("hidden");
  }

  // Fonction pour aller à l'image précédente
  function prevImage() {
    if (currentImageIndex > 0) {
      currentImageIndex--;
    } else {
      currentImageIndex = galleryImages.length - 1; // Boucle vers la fin
    }
    updateModalImage();
  }

  // Fonction pour aller à l'image suivante
  function nextImage() {
    if (currentImageIndex < galleryImages.length - 1) {
      currentImageIndex++;
    } else {
      currentImageIndex = 0; // Boucle vers le début
    }
    updateModalImage();
  }

  // Fonction pour mettre à jour l'image et la légende dans le modal
  function updateModalImage() {
    const modalImg = document.getElementById("imgModal");
    const captionText = document.getElementById("caption");

    modalImg.src = galleryImages[currentImageIndex].src;
    modalImg.alt = galleryImages[currentImageIndex].alt;
    captionText.textContent = galleryImages[currentImageIndex].alt;
  }

  // Fermer le modal lorsqu'on clique en dehors de l'image
  window.onclick = function(event) {
    const modal = document.getElementById("myModal");
    if (event.target === modal) {
      closeModal();
    }
  }

  // Optionnel : Fermer le modal en appuyant sur la touche "Échap"
  // et naviguer avec les flèches gauche et droite
  document.addEventListener('keydown', function(event) {
    const modal = document.getElementById("myModal");
    if (!modal.classList.contains("hidden")) {
      if (event.key === "Escape") {
        closeModal();
      }
      if (event.key === "ArrowLeft") {
        prevImage();
      }
      if (event.key === "ArrowRight") {
        nextImage();
      }
    }
  });
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
