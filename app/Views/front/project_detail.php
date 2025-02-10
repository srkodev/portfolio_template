<?php
$title = "Projet_détail";
require __DIR__ . '/../includes/header.php';
?>

<?php if (!empty($project['gallery'])): ?>
  <!-- Modal -->
  <div
    id="myModal"
    class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-80 z-50"
  >
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
        class="absolute top-1/2 left-4 transform -translate-y-1/2 text-white text-3xl font-bold focus:outline-none z-10"
        onclick="prevImage()"
        aria-label="Image précédente"
      >
        &#10094;
      </button>
      <!-- Bouton Suivant -->
      <button
        class="absolute top-1/2 right-4 transform -translate-y-1/2 text-white text-3xl font-bold focus:outline-none z-10"
        onclick="nextImage()"
        aria-label="Image suivante"
      >
        &#10095;
      </button>
      <!-- Image Agrandie -->
      <img
        id="imgModal"
        class="w-full h-auto max-h-[80vh] rounded-lg shadow-xl object-contain"
        alt="Image Agrandie"
      />
      <!-- Légende -->
      <p id="caption" class="mt-4 text-center text-white text-lg"></p>
    </div>
  </div>
<?php endif; ?>

<!-- WRAPPER principal (pour décaler à droite la page) -->
<div class="ml-0 md:ml-64 transition-all duration-300">

  <!-- HERO DU PROJET -->
  <section class="relative flex items-center justify-center min-h-[40vh] bg-gradient-to-br from-[#2c5364] via-[#203a43] to-[#0f2027]">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 text-center text-white px-4 py-16 fade-in max-w-3xl mx-auto">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold mb-4">
        <?= htmlspecialchars($project['title'] ?? 'Détail du Projet') ?>
      </h1>
      <p class="text-xl sm:text-2xl opacity-90">
        <?= $project['subtitle'] ?? 'Une brève phrase qui résume ce projet' ?>
      </p>
    </div>
  </section>

  <!-- SECTION DESCRIPTION PROJET -->
  <section class="bg-white py-16 px-4 fade-in">
    <div class="max-w-5xl mx-auto">
      <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-6">
        Présentation du Projet
      </h2>
      <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-8">
        <?= nl2br(htmlspecialchars($project['presentation'] ?? 'Description non disponible.')); ?>
      </p>

      <!-- Galerie d'Images -->
      <?php if (!empty($project['gallery'])): ?>
        <h3 class="text-xl font-bold text-gray-900 mb-4">
          Galerie d'Images
        </h3>
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
          <?php foreach ($project['gallery'] as $index => $img): ?>
            <div class="relative">
              <img
                src="<?= htmlspecialchars($img['src']) ?>"
                alt="<?= htmlspecialchars($img['alt']) ?>"
                class="w-full h-48 object-cover rounded-lg shadow-md cursor-pointer hover:scale-105 transition-transform"
                onclick="openModalWithIndex(<?= $index ?>)"
                data-index="<?= $index ?>"
              />
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <h3 class="text-xl font-bold text-gray-900 mt-10 mb-4">
        Technologies & Méthodologie
      </h3>
      <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
        <?= nl2br(htmlspecialchars($project['techno'] ?? 'Liste des technos, frameworks...')) ?>
      </p>

      <!-- Bouton de retour -->
      <div class="mt-8">
        <a
          href="index.php?action=home#projets"
          class="inline-block bg-gray-900 text-white font-semibold px-6 py-3 rounded-full hover:bg-gray-800 transition-transform hover:-translate-y-0.5"
        >
          Revenir aux projets
        </a>
      </div>
    </div>
  </section>
</div>

<!-- Script Modal -->
<script>
  let currentImageIndex = 0;
  let galleryImages = [];

  <?php if (!empty($project['gallery'])): ?>
    galleryImages = <?= json_encode(array_map(function($img) {
      return [
        'src' => $img['src'], 
        'alt' => htmlspecialchars($img['alt'])
      ];
    }, $project['gallery'])) ?>;
  <?php endif; ?>

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

  function closeModal() {
    const modal = document.getElementById("myModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  }

  function prevImage() {
    currentImageIndex = (currentImageIndex > 0)
      ? currentImageIndex - 1
      : galleryImages.length - 1;
    updateModalImage();
  }

  function nextImage() {
    currentImageIndex = (currentImageIndex < galleryImages.length - 1)
      ? currentImageIndex + 1
      : 0;
    updateModalImage();
  }

  function updateModalImage() {
    const modalImg = document.getElementById("imgModal");
    const captionText = document.getElementById("caption");
    modalImg.src = galleryImages[currentImageIndex].src;
    modalImg.alt = galleryImages[currentImageIndex].alt;
    captionText.textContent = galleryImages[currentImageIndex].alt;
  }

  window.onclick = function(event) {
    const modal = document.getElementById("myModal");
    if (event.target === modal) {
      closeModal();
    }
  }

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
