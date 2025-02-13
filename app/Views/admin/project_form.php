<?php
$title = "projet-form";
require __DIR__ . '/../includes/header.php';
?>
<!-- SECTION FORMULAIRE PROJET -->
<section class="py-16" data-aos="fade-up">
  <div class="max-w-3xl mx-auto px-4 fade-in bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">
      <?= $editing ? "Modifier le projet #" . $project['id'] : "Ajouter un nouveau projet" ?>
    </h1>
    <?php if (!empty($message)): ?>
      <div class="text-green-600 mb-4"><?= htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form id="project-form" method="post" enctype="multipart/form-data">
      <!-- Première partie : Présentation Principale -->
      <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Présentation Principale</h2>

        <!-- Champ Titre -->
        <div class="mb-6">
          <label for="title" class="block font-semibold mb-1 text-gray-900 dark:text-white">Titre</label>
          <input type="text"
                 id="title"
                 name="title"
                 class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                 value="<?= htmlspecialchars($project['title'] ?? ''); ?>"
                 required>
        </div>

        <!-- Champ Description -->
        <div class="mb-6">
          <label for="description" class="block font-semibold mb-1 text-gray-900 dark:text-white">Description</label>
          <textarea id="description"
                    name="description"
                    class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                    rows="3"><?= htmlspecialchars($project['description'] ?? ''); ?></textarea>
        </div>

        <!-- Image Principale -->
        <div class="mb-6">
          <label for="image" class="block font-semibold mb-1 text-gray-900 dark:text-white">Image Principale</label>
          <input type="file"
                 id="image"
                 name="image"
                 accept="image/*"
                 class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
          <div id="main-image-preview" class="mt-2"></div>
          <?php if ($editing && !empty($project['image'])): ?>
            <div class="mt-2">
              <?php $imagePath = str_replace('uploads/', '', $project['image']); ?>
              <img src="uploads/<?= htmlspecialchars($imagePath); ?>"
                   alt="Image principale actuelle"
                   class="w-32 h-32 object-cover rounded">
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                Image actuelle : <?= htmlspecialchars($imagePath); ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Deuxième partie : Contenu Détaillé -->
      <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Contenu Détaillé</h2>

        <!-- Champ Présentation détaillée -->
        <div class="mb-6">
          <label for="presentation" class="block font-semibold mb-1 text-gray-900 dark:text-white">Présentation détaillée</label>
          <textarea id="presentation"
                    name="presentation"
                    class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                    rows="6"><?= htmlspecialchars($project['presentation'] ?? ''); ?></textarea>
        </div>

        <!-- Champ Compétences utilisées -->
        <div class="mb-6">
          <label class="block font-semibold mb-1 text-gray-900 dark:text-white">Compétences utilisées</label>

          <!-- Section des compétences sélectionnées -->
          <div id="selected-competences" class="mb-4">
            <h3 class="text-sm font-semibold mb-2 text-gray-900 dark:text-white">Compétences sélectionnées</h3>
            <div id="selected-competences-list" class="flex flex-wrap gap-2">
              <?php if (!empty($projectCompetences)): ?>
                <?php foreach ($projectCompetences as $compId): ?>
                  <?php
                    $comp = null;
                    foreach ($allCompetences as $c) {
                      if ($c['id'] == $compId) {
                        $comp = $c;
                        break;
                      }
                    }
                  ?>
                  <?php if ($comp): ?>
                    <div class="competence-card flex items-center bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full" data-id="<?= $comp['id'] ?>">
                      <span class="mr-2"><?= htmlspecialchars($comp['title']) ?></span>
                      <button type="button" class="remove-competence text-indigo-600 hover:text-indigo-800" data-id="<?= $comp['id'] ?>">&times;</button>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>

          <!-- Séparateur pour les compétences disponibles -->
          <div class="mb-4">
            <h3 class="text-sm font-semibold mb-2 text-gray-900 dark:text-white">Compétences disponibles</h3>
            <div id="available-competences" class="flex flex-wrap gap-2">
              <?php foreach ($allCompetences as $comp): ?>
                <?php if (!in_array($comp['id'], $projectCompetences)): ?>
                  <div class="competence-card flex items-center bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full" data-id="<?= $comp['id'] ?>">
                    <span class="mr-2"><?= htmlspecialchars($comp['title']) ?></span>
                    <button type="button" class="add-competence text-indigo-600 hover:text-indigo-800" data-id="<?= $comp['id'] ?>" data-title="<?= htmlspecialchars($comp['title']) ?>">+</button>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Champ Lien -->
        <div class="mb-6">
          <label for="link" class="block font-semibold mb-1 text-gray-900 dark:text-white">Lien</label>
          <input type="url"
                 id="link"
                 name="link"
                 class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                 value="<?= htmlspecialchars($project['link'] ?? ''); ?>"
                 placeholder="https://exemple.com">
        </div>

        <!-- Galerie d'Images -->
        <div class="mb-6">
          <label for="gallery-input" class="block font-semibold mb-1 text-gray-900 dark:text-white">Galerie d'Images</label>
          <input type="file"
                 id="gallery-input"
                 name="gallery_images[]"
                 multiple
                 accept="image/*"
                 class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
            Maximum 10 images, 5MB par image
          </p>

          <!-- Prévisualisation de la galerie -->
          <div id="gallery-preview" class="grid grid-cols-3 gap-4 mt-4">
            <?php foreach ($gallery as $img): ?>
              <?php $galleryImagePath = str_replace('uploads/', '', $img['src']); ?>
              <div class="relative group" data-image-id="<?= $img['id'] ?>">
                <img src="uploads/<?= htmlspecialchars($galleryImagePath); ?>"
                     alt="<?= htmlspecialchars($img['alt']); ?>"
                     class="w-full h-32 object-cover rounded">
                <button type="button"
                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                        onclick="deleteImage(<?= $img['id'] ?>)">
                  ×
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Champ caché pour les images à supprimer -->
      <input type="hidden" name="delete_images" id="delete-images-input">

      <!-- Champ caché pour les compétences sélectionnées (valeur JSON encodée) -->
      <input type="hidden" name="competences" id="competences-input" value='<?= htmlspecialchars(json_encode($projectCompetences)); ?>'>

      <!-- Bouton de soumission -->
      <div class="flex justify-end mt-6">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
          <?= $editing ? 'Mettre à jour' : 'Créer' ?>
        </button>
      </div>
    </form>
  </div>
</section>

<script>
// Variables globales
// Conversion des compétences en nombres dès le départ
let selectedCompetences = JSON.parse(document.getElementById('competences-input').value || '[]').map(id => Number(id));
const maxFileSize = 5 * 1024 * 1024; // 5MB
const maxFiles = 10;

// Vérification de la taille de l'image principale (8MB maximum)
document.getElementById('image').addEventListener('change', function(e) {
  const file = this.files[0];
  if (file && file.size > 8388608) {
    alert("L'image principale dépasse la taille maximale autorisée de 8MB.");
    this.value = "";
  }
});

// Fonction de suppression d'image
function deleteImage(imageId) {
  if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
    const imageDiv = document.querySelector(`[data-image-id="${imageId}"]`);
    if (imageDiv) {
      imageDiv.remove();
      deletedImages.push(imageId);
      document.getElementById('delete-images-input').value = JSON.stringify(deletedImages);
    }
  }
}

// Prévisualisation des images de la galerie
document.getElementById('gallery-input').addEventListener('change', function(e) {
  const files = Array.from(e.target.files);
  const galleryPreview = document.getElementById('gallery-preview');
  const currentImages = document.querySelectorAll('#gallery-preview .relative').length;
  if (currentImages + files.length > maxFiles) {
    alert(`Le nombre total d'images ne peut pas dépasser ${maxFiles}.`);
    this.value = '';
    return;
  }
  for (const file of files) {
    if (file.size > maxFileSize) {
      alert(`Le fichier ${file.name} dépasse la taille maximale de 5MB.`);
      this.value = '';
      return;
    }
    if (!file.type.startsWith('image/')) {
      alert(`Le fichier ${file.name} n'est pas une image.`);
      this.value = '';
      return;
    }
    const reader = new FileReader();
    reader.onload = function(event) {
      const div = document.createElement('div');
      div.className = 'relative group';
      div.innerHTML = `
        <img src="${event.target.result}"
             alt="${file.name}"
             class="w-full h-32 object-cover rounded">
        <button type="button"
                class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
          ×
        </button>
      `;
      div.querySelector('button').addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir retirer cette image ?')) {
          div.remove();
        }
      });
      galleryPreview.appendChild(div);
    };
    reader.readAsDataURL(file);
  }
});

// ----------------------
// Gestion des compétences
// ----------------------

// Ajout d'une compétence (depuis la section "disponible")
document.querySelectorAll('.add-competence').forEach(button => {
  button.addEventListener('click', function() {
    const id = Number(this.getAttribute('data-id'));
    const title = this.getAttribute('data-title');
    if (!selectedCompetences.includes(id)) {
      selectedCompetences.push(id);
      document.getElementById('competences-input').value = JSON.stringify(selectedCompetences);
      const availableCard = this.closest('.competence-card');
      if (availableCard) availableCard.remove();
      const selectedList = document.getElementById('selected-competences-list');
      const selectedCard = document.createElement('div');
      selectedCard.className = 'flex items-center bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full';
      selectedCard.setAttribute('data-id', id);
      selectedCard.innerHTML = `<span class="mr-2">${title}</span>
              <button type="button" class="remove-competence text-indigo-600 hover:text-indigo-800" data-id="${id}">&times;</button>`;
      selectedList.appendChild(selectedCard);
    }
  });
});

// Suppression d'une compétence (depuis la section sélectionnée)
document.getElementById('selected-competences-list').addEventListener('click', function(e) {
  if (e.target.classList.contains('remove-competence')) {
    const id = Number(e.target.getAttribute('data-id'));
    removeCompetence(id);
  }
});

function removeCompetence(id) {
  selectedCompetences = selectedCompetences.filter(compId => compId !== id);
  document.getElementById('competences-input').value = JSON.stringify(selectedCompetences);
  const selectedCard = document.querySelector(`#selected-competences-list [data-id="${id}"]`);
  if (selectedCard) {
    const title = selectedCard.querySelector('span').innerText;
    selectedCard.remove();
    const availableCard = document.createElement('div');
    availableCard.className = 'competence-card flex items-center bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full';
    availableCard.setAttribute('data-id', id);
    availableCard.innerHTML = `<span class="mr-2">${title}</span>
              <button type="button" class="add-competence text-indigo-600 hover:text-indigo-800" data-id="${id}" data-title="${title}">+</button>`;
    document.getElementById('available-competences').appendChild(availableCard);
    availableCard.querySelector('.add-competence').addEventListener('click', function() {
      const id = Number(this.getAttribute('data-id'));
      const title = this.getAttribute('data-title');
      if (!selectedCompetences.includes(id)) {
        selectedCompetences.push(id);
        document.getElementById('competences-input').value = JSON.stringify(selectedCompetences);
        const card = this.closest('.competence-card');
        if (card) card.remove();
        const selectedList = document.getElementById('selected-competences-list');
        const selectedCard = document.createElement('div');
        selectedCard.className = 'flex items-center bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full';
        selectedCard.setAttribute('data-id', id);
        selectedCard.innerHTML = `<span class="mr-2">${title}</span>
                  <button type="button" class="remove-competence text-indigo-600 hover:text-indigo-800" data-id="${id}">&times;</button>`;
        selectedList.appendChild(selectedCard);
      }
    });
  }
}

// Validation du formulaire
document.getElementById('project-form').addEventListener('submit', function(e) {
  const currentImagesCount = document.querySelectorAll('#gallery-preview .relative').length;
  if (currentImagesCount > maxFiles) {
    e.preventDefault();
    alert(`Le nombre total d'images ne peut pas dépasser ${maxFiles}.`);
    return;
  }
});
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
