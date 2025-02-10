<?php
$title = "Modifier le contenu";
require __DIR__ . '/../includes/header.php';
?>

<!-- SECTION MODIFICATION DE CONTENU -->
<section class="container mx-auto px-4 py-16" data-aos="fade-up">
  <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-4 dark:text-white">
      Modifier le contenu "<?= htmlspecialchars($contentKey); ?>"
    </h1>

    <form method="post" enctype="multipart/form-data">
      <!-- Champ texte -->
      <div class="mb-6">
        <label class="block font-semibold mb-2 dark:text-gray-200">
          Texte
        </label>
        <textarea
          name="content_text"
          rows="5"
          class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded 
                 focus:outline-none focus:ring-2 focus:ring-indigo-600
                 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
        ><?= htmlspecialchars($currentContent['text'] ?? ''); ?></textarea>
      </div>

      <!-- Champ image avec Drag and Drop -->
      <div class="mb-6">
        <label class="block font-semibold mb-2 dark:text-gray-200">
          Image (optionnel)
        </label>
        <!-- Drag and Drop Container -->
        <div
          id="imageDropzone"
          class="w-full border-2 border-dashed border-gray-300 dark:border-gray-600 
                 rounded p-6 flex flex-col items-center justify-center 
                 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 
                 transition-colors cursor-pointer"
        >
          <p class="text-gray-500 dark:text-gray-300">
            Déposez une image ici ou cliquez pour sélectionner
          </p>
          <input
            type="file"
            name="content_image"
            accept="image/*"
            class="hidden"
            id="imageInput"
          >
        </div>
        <!-- Aperçu de l'image actuelle ou sélectionnée -->
        <div id="imagePreview" class="mt-4">
          <?php if (!empty($currentContent['image'])): ?>
            <img
              src="<?= htmlspecialchars($currentContent['image']); ?>"
              alt="Image actuelle"
              class="w-full h-48 object-cover rounded-lg shadow"
            >
          <?php endif; ?>
        </div>
      </div>

      <!-- Boutons -->
      <div class="flex items-center">
        <button
          type="submit"
          class="bg-indigo-600 text-white px-4 py-2 rounded 
                 hover:bg-indigo-700 transition"
        >
          Enregistrer
        </button>
        <a
          href="index.php?action=admin_dashboard"
          class="ml-4 text-blue-600 hover:underline"
        >
          Annuler
        </a>
      </div>
    </form>
  </div>
</section>

<!-- Script Drag & Drop + Aperçu -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const dropzone = document.getElementById('imageDropzone');
    const fileInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreview');

    // Ouvrir le sélecteur de fichiers au clic
    dropzone.addEventListener('click', () => fileInput.click());

    // Sélection de fichier via le sélecteur
    fileInput.addEventListener('change', () => {
      if (fileInput.files && fileInput.files[0]) {
        previewFile(fileInput.files[0]);
      }
    });

    // Survol de la dropzone
    dropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropzone.classList.add('border-indigo-600', 'bg-gray-100', 'dark:bg-gray-600');
    });

    // Fin du survol
    dropzone.addEventListener('dragleave', () => {
      dropzone.classList.remove('border-indigo-600', 'bg-gray-100', 'dark:bg-gray-600');
    });

    // Dépôt de fichiers
    dropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropzone.classList.remove('border-indigo-600', 'bg-gray-100', 'dark:bg-gray-600');
      if (e.dataTransfer.files && e.dataTransfer.files[0]) {
        fileInput.files = e.dataTransfer.files;
        previewFile(e.dataTransfer.files[0]);
      }
    });

    // Affichage de l'aperçu de l'image
    function previewFile(file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewContainer.innerHTML = `
          <img
            src="${e.target.result}"
            alt="Image sélectionnée"
            class="w-full h-48 object-cover rounded-lg shadow"
          >
        `;
      };
      reader.readAsDataURL(file);
    }
  });
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
