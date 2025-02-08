<?php
$title = "Modifier le contenu";
require __DIR__ . '/../includes/header.php';
?>
<body class="bg-gray-100">
  <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow">
    <h1 class="text-2xl font-bold mb-4">Modifier le contenu "<?= htmlspecialchars($contentKey); ?>"</h1>

    <form method="post" enctype="multipart/form-data">
      <!-- Champ texte -->
      <div class="mb-6">
        <label class="block font-semibold mb-2">Texte</label>
        <textarea name="content_text" rows="5" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600"><?= htmlspecialchars($currentContent['text'] ?? ''); ?></textarea>
      </div>

      <!-- Champ image avec Drag and Drop -->
      <div class="mb-6">
        <label class="block font-semibold mb-2">Image (optionnel)</label>
        <!-- Drag and Drop Container -->
        <div
          id="imageDropzone"
          class="w-full border-2 border-dashed border-gray-300 rounded p-6 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer"
        >
          <p class="text-gray-500">Déposez une image ici ou cliquez pour sélectionner</p>
          <input type="file" name="content_image" accept="image/*" class="hidden" id="imageInput">
        </div>
        <!-- Aperçu de l'image actuelle ou sélectionnée -->
        <div id="imagePreview" class="mt-4">
          <?php if (!empty($currentContent['image'])): ?>
            <img src="<?= htmlspecialchars($currentContent['image']); ?>" alt="Image actuelle" class="w-full h-48 object-cover rounded-lg shadow">
          <?php endif; ?>
        </div>
      </div>

      <!-- Boutons -->
      <div class="flex items-center">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Enregistrer</button>
        <a href="index.php?action=admin_dashboard" class="ml-4 text-blue-600 hover:underline">Annuler</a>
      </div>
    </form>
  </div>

  <!-- Ajout du JavaScript pour gérer le drag and drop et l'aperçu de l'image -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const dropzone = document.getElementById('imageDropzone');
      const fileInput = document.getElementById('imageInput');
      const previewContainer = document.getElementById('imagePreview');

      // Ouvrir le sélecteur de fichiers lorsqu'on clique sur la dropzone
      dropzone.addEventListener('click', () => fileInput.click());

      // Gérer le changement de fichier via le sélecteur
      fileInput.addEventListener('change', () => {
        if (fileInput.files && fileInput.files[0]) {
          previewFile(fileInput.files[0]);
        }
      });

      // Gérer le survol de la dropzone
      dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-indigo-600', 'bg-gray-100');
      });

      // Gérer le retrait du survol
      dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-indigo-600', 'bg-gray-100');
      });

      // Gérer le dépôt de fichiers
      dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-indigo-600', 'bg-gray-100');
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
          fileInput.files = e.dataTransfer.files;
          previewFile(e.dataTransfer.files[0]);
        }
      });

      // Fonction pour afficher l'aperçu de l'image
      function previewFile(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewContainer.innerHTML = `
            <img src="${e.target.result}" alt="Image sélectionnée" class="w-full h-48 object-cover rounded-lg shadow">
          `;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
<?php require __DIR__ . '/../includes/footer.php'; ?>
