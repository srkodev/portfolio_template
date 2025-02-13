<?php
$title = "Projet - Détail";
require __DIR__ . '/../includes/header.php';
?>

<?php if (!empty($project['gallery'])): ?>
  <!-- MODAL (Lightbox) : fond semi-transparent sur tout l'écran -->
  <div id="myModal" class="fixed inset-0 hidden bg-black bg-opacity-80 z-50 flex items-center justify-center">
    <!-- Conteneur central pour l'image et la légende -->
    <div class="relative max-w-3xl w-full mx-4">
      <!-- Image agrandie -->
      <img
        id="imgModal"
        class="w-full h-auto max-h-[80vh] rounded-lg shadow-xl object-contain"
        alt="Image agrandie"
      />
      <!-- Légende -->
      <p id="caption" class="mt-4 text-center text-white text-lg"></p>
    </div>
    <!-- Bouton Précédent positionné vers le bord gauche de l'écran -->
    <button
      class="absolute left-0 top-1/2 transform -translate-y-1/2 ml-4 text-white text-3xl font-bold focus:outline-none z-10"
      onclick="prevImage()"
      aria-label="Image précédente"
    >
      &#10094;
    </button>
    <!-- Bouton Suivant positionné vers le bord droit de l'écran -->
    <button
      class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-4 text-white text-3xl font-bold focus:outline-none z-10"
      onclick="nextImage()"
      aria-label="Image suivante"
    >
      &#10095;
    </button>
    <!-- Bouton de fermeture positionné dans le coin supérieur droit -->
    <button
      class="absolute top-4 right-4 text-white text-3xl font-bold focus:outline-none z-10"
      onclick="closeModal()"
      aria-label="Fermer le modal"
    >
      &times;
    </button>
  </div>
<?php endif; ?>

<!-- SECTION HERO DU PROJET (aucun bg forcé) -->
<section class="container mx-auto px-4 sm:px-6 md:px-8 lg:px-16 py-16" data-aos="fade-up">
  <div class="text-center">
    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold mb-4">
      <?= htmlspecialchars($project['title'] ?? 'Détail du Projet') ?>
    </h1>
    <p class="text-xl sm:text-2xl opacity-90">
      <?= htmlspecialchars($project['subtitle'] ?? 'Une brève phrase qui résume ce projet') ?>
    </p>
  </div>
</section>

<!-- SECTION CONTENU DU PROJET (pas de bg explicite) -->
<section class="container mx-auto px-4 sm:px-6 md:px-8 lg:px-16 py-8" data-aos="fade-up">
  <?php if (!empty($project['link'])): ?>
    <div class="flex justify-start mb-6">
      <a href="<?= htmlspecialchars($project['link']) ?>" target="_blank" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition" aria-label="Lien vers le projet">
        <!-- Icône de lien avec changement de couleur selon le thème -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-black dark:text-white">
          <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
          <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
        </svg>
      </a>
    </div>
  <?php endif; ?>

  <!-- Présentation -->
  <h2 class="text-2xl sm:text-3xl font-extrabold mb-6">
    Présentation du Projet
  </h2>
  <p class="text-base sm:text-lg leading-relaxed mb-8">
    <?= nl2br(htmlspecialchars($project['presentation'] ?? 'Description non disponible.')) ?>
  </p>

  <!-- Galerie d'Images -->
  <?php if (!empty($project['gallery'])): ?>
    <h3 class="text-xl font-bold mb-4">
      Galerie d'Images
    </h3>
    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
      <?php foreach ($project['gallery'] as $index => $img): ?>
        <div class="rounded-lg shadow-md overflow-hidden cursor-pointer transform hover:scale-105 transition-transform"
             onclick="openModalWithIndex(<?= $index ?>)">
          <img
            src="<?= htmlspecialchars($img['src']) ?>"
            alt="<?= htmlspecialchars($img['alt']) ?>"
            class="w-full h-48 object-cover"
            data-index="<?= $index ?>"
          />
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <!-- Compétences utilisées (Technologies & Méthodologie) -->
  <h3 class="text-xl font-bold mt-10 mb-4">
    Technologies & Méthodologie
  </h3>
  <?php if (!empty($projectCompetences)): ?>
    <div class="flex flex-wrap gap-4">
      <?php foreach ($projectCompetences as $comp): ?>
        <a href="index.php?action=home&competence=<?= $comp['id'] ?>"
           title="Voir les projets avec cette compétence"
           class="flex items-center space-x-2 bg-gray-200 dark:bg-gray-700 p-2 rounded">
          <?php if (!empty($comp['icon'])): ?>
            <img src="<?= htmlspecialchars($comp['icon']) ?>" alt="<?= htmlspecialchars($comp['title']) ?>" class="h-6 w-6">
          <?php endif; ?>
          <span class="text-gray-800 dark:text-gray-200"><?= htmlspecialchars($comp['title']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-base sm:text-lg leading-relaxed">Aucune compétence assignée.</p>
  <?php endif; ?>

  <!-- Bouton de retour -->
  <div class="mt-8">
    <a href="index.php?action=home#projects"
       class="inline-block bg-lightCard dark:bg-darkCard text-black dark:text-white font-semibold px-6 py-3 rounded-full shadow-md hover:shadow-lg transition-transform hover:-translate-y-0.5">
      Revenir aux projets
    </a>
  </div>
</section>

<!-- SCRIPT DU MODAL (Lightbox) -->
<script>
  let currentImageIndex = 0;
  let galleryImages = [];

  <?php if (!empty($project['gallery'])): ?>
    // Conversion de la galerie PHP en tableau JS
    galleryImages = <?= json_encode(array_map(function($img) {
      return [
        'src' => $img['src'],
        'alt' => htmlspecialchars($img['alt'])
      ];
    }, $project['gallery'])) ?>;
  <?php endif; ?>

  // Ouvrir le modal
  function openModalWithIndex(index) {
    currentImageIndex = index;
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("imgModal");
    const captionText = document.getElementById("caption");

    modalImg.src = galleryImages[index].src;
    modalImg.alt = galleryImages[index].alt;
    captionText.textContent = galleryImages[index].alt;

    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }

  // Fermer le modal
  function closeModal() {
    const modal = document.getElementById("myModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  }

  // Image précédente
  function prevImage() {
    currentImageIndex = (currentImageIndex > 0)
      ? currentImageIndex - 1
      : galleryImages.length - 1;
    updateModalImage();
  }

  // Image suivante
  function nextImage() {
    currentImageIndex = (currentImageIndex < galleryImages.length - 1)
      ? currentImageIndex + 1
      : 0;
    updateModalImage();
  }

  // Met à jour l'image du modal
  function updateModalImage() {
    const modalImg = document.getElementById("imgModal");
    const captionText = document.getElementById("caption");
    modalImg.src = galleryImages[currentImageIndex].src;
    modalImg.alt = galleryImages[currentImageIndex].alt;
    captionText.textContent = galleryImages[currentImageIndex].alt;
  }

  // Fermer le modal en cliquant à l'extérieur
  window.onclick = function(event) {
    const modal = document.getElementById("myModal");
    if (event.target === modal) {
      closeModal();
    }
  }

  // Navigation avec le clavier
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
