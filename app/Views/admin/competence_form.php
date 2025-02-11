<?php
$title = $editing ? "Modifier la compétence" : "Ajouter une compétence";
require __DIR__ . '/../includes/header.php';
?>
<!-- SECTION FORMULAIRE COMPÉTENCE -->
<section class="py-16" data-aos="fade-up">
  <div class="max-w-3xl mx-auto px-4 fade-in bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">
      <?= $editing ? "Modifier la compétence #".$competence['id'] : "Ajouter une nouvelle compétence" ?>
    </h1>

    <?php if (!empty($message)): ?>
      <div class="text-green-600 mb-4"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <!-- Partie Compétence -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-indigo-600 mb-4">Détails de la compétence</h2>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-900 dark:text-white">Titre</label>
          <input
            type="text"
            name="title"
            class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            value="<?= htmlspecialchars($competence['title'] ?? '') ?>"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-900 dark:text-white">Description</label>
          <textarea
            name="description"
            rows="4"
            class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            required
          ><?= htmlspecialchars($competence['description'] ?? '') ?></textarea>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-900 dark:text-white">Catégorie</label>
          <select
            name="category"
            class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            required
          >
            <option value="">Sélectionnez une catégorie</option>
            <option value="Front end" <?= (isset($competence['category']) && $competence['category'] === "Front end") ? 'selected' : '' ?>>Front end</option>
            <option value="Back end" <?= (isset($competence['category']) && $competence['category'] === "Back end") ? 'selected' : '' ?>>Back end</option>
            <option value="CMS" <?= (isset($competence['category']) && $competence['category'] === "CMS") ? 'selected' : '' ?>>CMS</option>
            <option value="Frameworks" <?= (isset($competence['category']) && $competence['category'] === "Frameworks") ? 'selected' : '' ?>>Frameworks</option>
            <option value="outils" <?= (isset($competence['category']) && $competence['category'] === "outils") ? 'selected' : '' ?>>Outils</option>
            <option value="base de données" <?= (isset($competence['category']) && $competence['category'] === "base de données") ? 'selected' : '' ?>>Base de données</option>
            <option value="design" <?= (isset($competence['category']) && $competence['category'] === "design") ? 'selected' : '' ?>>Design</option>
            <option value="dev ops" <?= (isset($competence['category']) && $competence['category'] === "dev ops") ? 'selected' : '' ?>>Dev Ops</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-2 text-gray-900 dark:text-white">Icône (SVG uniquement)</label>
          <!-- Drag and Drop Container -->
          <div
            id="iconDropzone"
            class="w-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded p-6 flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors cursor-pointer"
          >
            <p class="text-gray-500 dark:text-gray-300">Déposez un fichier SVG ici ou cliquez pour sélectionner</p>
            <input type="file" name="iconFile" accept=".svg,image/svg+xml" class="hidden" id="iconInput">
          </div>
          <!-- Aperçu de l'icône actuelle ou sélectionnée -->
          <div id="iconPreview" class="mt-4">
            <?php if ($editing && !empty($competence['icon'])): ?>
              <img src="<?= htmlspecialchars($competence['icon']); ?>" alt="Icône actuelle" class="w-16 h-16 object-contain rounded-lg shadow">
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Boutons -->
      <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
        Enregistrer
      </button>
      <a href="index.php?action=admin_competences_list" class="ml-4 text-blue-600 hover:underline">Annuler</a>
      <a href="index.php?action=home" class="ml-4 text-blue-600 hover:underline">Site Principal</a>
    </form>
  </div>
</section>

<!-- JavaScript pour le drag & drop de l'icône SVG -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const dropzone = document.getElementById('iconDropzone');
  const fileInput = document.getElementById('iconInput');
  const previewContainer = document.getElementById('iconPreview');

  // Ouvrir le sélecteur de fichiers lors du clic sur la dropzone
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
    dropzone.classList.add('border-indigo-600', 'bg-gray-100', 'dark:bg-gray-600');
  });

  // Gérer le retrait du survol
  dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('border-indigo-600', 'bg-gray-100', 'dark:bg-gray-600');
  });

  // Gérer le dépôt de fichiers
  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('border-indigo-600', 'bg-gray-100', 'dark:bg-gray-600');
    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
      const file = e.dataTransfer.files[0];
      if (file.type === 'image/svg+xml') {
        fileInput.files = e.dataTransfer.files;
        previewFile(file);
      } else {
        alert('Veuillez déposer un fichier SVG uniquement.');
      }
    }
  });

  // Fonction pour afficher l'aperçu de l'icône SVG
  function previewFile(file) {
    if (file.type !== 'image/svg+xml') {
      alert('Veuillez sélectionner un fichier SVG.');
      return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
      previewContainer.innerHTML = `
        <img src="${e.target.result}" alt="Icône sélectionnée" class="w-16 h-16 object-contain rounded-lg shadow">
      `;
    };
    reader.readAsDataURL(file);
  }
});
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
