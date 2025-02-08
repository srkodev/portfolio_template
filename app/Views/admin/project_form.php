<?php
$title = "projet-form";
require __DIR__ . '/../includes/header.php';
?>
<section class="bg-white py-16">
    <div class="max-w-3xl mx-auto px-4 fade-in">
        <h1 class="text-2xl font-bold mb-4">
            <?= $editing ? "Modifier le projet #" . $project['id'] : "Ajouter un nouveau projet" ?>
        </h1>
        <?php if (!empty($message)): ?>
            <div class="text-green-600 mb-4"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <form id="project-form" method="post" enctype="multipart/form-data">
            <!-- Première partie : Présentation principale -->
            <div class="bg-gray-50 p-6 rounded-lg mb-8">
                <h2 class="text-xl font-semibold mb-4">Présentation Principale</h2>
                
                <!-- Champ Titre -->
                <div class="mb-6">
                    <label for="title" class="block font-semibold mb-1">Titre</label>
                    <input type="text" 
                           id="title"
                           name="title" 
                           class="w-full border p-2 rounded"
                           value="<?= htmlspecialchars($project['title'] ?? ''); ?>" 
                           required>
                </div>

                <!-- Champ Présentation -->
                <div class="mb-6">
                    <label for="presentation" class="block font-semibold mb-1">Présentation détaillée</label>
                    <textarea id="presentation"
                             name="presentation" 
                             class="w-full border p-2 rounded" 
                             rows="6"><?= htmlspecialchars($project['presentation'] ?? ''); ?></textarea>
                </div>

                <!-- Image Principale -->
                <div class="mb-6">
                    <label for="image" class="block font-semibold mb-1">Image Principale</label>
                    <input type="file" 
                           id="image"
                           name="image" 
                           accept="image/*" 
                           class="w-full border p-2 rounded">
                    <div id="main-image-preview" class="mt-2"></div>
                    <?php if ($editing && !empty($project['image'])): ?>
                        <div class="mt-2">
                            <?php
                            $imagePath = str_replace('uploads/', '', $project['image']);
                            ?>
                            <img src="uploads/<?= htmlspecialchars($imagePath); ?>" 
                                 alt="Image principale actuelle" 
                                 class="w-32 h-32 object-cover rounded">
                            <p class="mt-1 text-sm text-gray-600">
                                Image actuelle : <?= htmlspecialchars($imagePath); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Deuxième partie : Contenu détaillé -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Contenu Détaillé</h2>

                <!-- Champ Description -->
                <div class="mb-6">
                    <label for="description" class="block font-semibold mb-1">Description</label>
                    <textarea id="description"
                             name="description" 
                             class="w-full border p-2 rounded" 
                             rows="3"><?= htmlspecialchars($project['description'] ?? ''); ?></textarea>
                </div>

                <!-- Champ Technologies -->
                <div class="mb-6">
                    <label for="techno" class="block font-semibold mb-1">Technologies</label>
                    <textarea id="techno"
                             name="techno" 
                             class="w-full border p-2 rounded" 
                             rows="3"><?= htmlspecialchars($project['techno'] ?? ''); ?></textarea>
                </div>

                <!-- Galerie d'Images -->
                <div class="mb-6">
                    <label for="gallery-input" class="block font-semibold mb-1">Galerie d'Images</label>
                    <input type="file" 
                           id="gallery-input" 
                           name="gallery_images[]" 
                           multiple 
                           accept="image/*" 
                           class="w-full border p-2 rounded">
                    <p class="mt-1 text-sm text-gray-500">
                        Maximum 10 images, 5MB par image
                    </p>

                    <!-- Prévisualisation de la galerie -->
                    <div id="gallery-preview" class="grid grid-cols-3 gap-4 mt-4">
                        <?php foreach ($gallery as $img): ?>
                            <?php
                            $galleryImagePath = str_replace('uploads/', '', $img['src']);
                            ?>
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
let deletedImages = [];
const maxFileSize = 5 * 1024 * 1024; // 5MB
const maxFiles = 10;

// Prévisualisation de l'image principale
document.getElementById('image').addEventListener('change', function(e) {
    // ... code inchangé ...
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

// Prévisualisation des nouvelles images de la galerie
document.getElementById('gallery-input').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    const galleryPreview = document.getElementById('gallery-preview');
    
    // Vérification du nombre total d'images
    const currentImages = document.querySelectorAll('#gallery-preview .relative').length;
    if (currentImages + files.length > maxFiles) {
        alert(`Le nombre total d'images ne peut pas dépasser ${maxFiles}.`);
        this.value = '';
        return;
    }

    // Vérifier chaque fichier
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

        // Création de la prévisualisation
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
            
            // Gestion de la suppression de la prévisualisation
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

// Validation du formulaire
document.getElementById('project-form').addEventListener('submit', function(e) {
    const galleryInput = document.getElementById('gallery-input');
    const files = galleryInput.files;
    const currentImagesCount = document.querySelectorAll('#gallery-preview .relative').length;
    
    if (currentImagesCount > maxFiles) {
        e.preventDefault();
        alert(`Le nombre total d'images ne peut pas dépasser ${maxFiles}.`);
        return;
    }
});
</script>


<?php require __DIR__ . '/../includes/footer.php'; ?>