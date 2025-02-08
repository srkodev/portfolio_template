<?php
$title = "projet-form";
require __DIR__ . '/../includes/header.php';
?>
  <section class="bg-white py-16">
    <div class="max-w-3xl mx-auto px-4 fade-in">
      <h1 class="text-2xl font-bold mb-4">
        <?= $editing ? "Modifier le projet #".$project['id'] : "Ajouter un nouveau projet" ?>
      </h1>
      <?php if (!empty($message)): ?>
        <div class="text-green-600 mb-4"><?= htmlspecialchars($message); ?></div>
      <?php endif; ?>
      <form method="post" enctype="multipart/form-data">
        <!-- PARTIE HOME -->
        <div class="mb-6">
          <h2 class="text-xl font-semibold text-indigo-600 mb-4">Page Home</h2>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Titre</label>
            <input type="text" name="title" class="w-full border p-2 rounded"
                   value="<?= htmlspecialchars($project['title'] ?? ''); ?>" required>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Description (courte)</label>
            <textarea name="description" rows="3" class="w-full border p-2 rounded"><?= htmlspecialchars($project['description'] ?? ''); ?></textarea>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Image Principale (upload)</label>
            <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
            <?php if ($editing && !empty($project['image'])): ?>
              <p class="mt-2 text-sm text-gray-600">
                Image actuelle : <a href="<?= htmlspecialchars($project['image']); ?>" target="_blank"><?= htmlspecialchars($project['image']); ?></a>
              </p>
            <?php endif; ?>
          </div>
        </div>
        <!-- PARTIE DETAIL -->
        <div class="mb-6">
          <h2 class="text-xl font-semibold text-indigo-600 mb-4">Page Détail</h2>
          <div class="mb-4">
          <div class="mb-4">
            <label class="block font-semibold mb-1">Présantation du projet</label>
            <textarea name="presentation" rows="5" class="w-full border p-2 rounded"><?= htmlspecialchars($project['presentation'] ?? ''); ?></textarea>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Technologies & Méthodologie</label>
            <textarea name="techno" rows="3" class="w-full border p-2 rounded"><?= htmlspecialchars($project['techno'] ?? ''); ?></textarea>
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Galerie d'Images (upload multiple)</label>
            <input type="file" name="gallery_images[]" accept="image/*" multiple class="w-full border p-2 rounded">
            <?php if ($editing && !empty($gallery)): ?>
              <div class="grid grid-cols-3 gap-4 mt-2">
                <?php foreach ($gallery as $img): ?>
                  <div class="relative">
                    <img src="<?= htmlspecialchars($img['src']); ?>" alt="<?= htmlspecialchars($img['alt']); ?>" class="w-full h-32 object-cover rounded shadow">
                    <a href="index.php?action=admin_project_delete_gallery_image&id=<?= $img['id']; ?>" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 transition" onclick="return confirm('Supprimer cette image ?')">&times;</a>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Enregistrer</button>
        <a href="index.php?action=admin_projects_list" class="ml-4 text-blue-600 hover:underline">Annuler</a>
        <a
          href="index.php?action=home"
          class="ml-4 text-blue-600 hover:underline"
        >
          Site Principal
        </a>
      </form>
    </div>
  </section>
  <?php require __DIR__ . '/../includes/footer.php';  ?>
