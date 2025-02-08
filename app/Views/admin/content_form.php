<?php
$title = "Modifier le contenu";
require __DIR__ . '/../includes/header.php';
?>
<body class="bg-gray-100">
  <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow">
    <h1 class="text-2xl font-bold mb-4">Modifier le contenu "<?= htmlspecialchars($contentKey); ?>"</h1>

    <form method="post" enctype="multipart/form-data">
      <!-- Champ texte -->
      <div class="mb-4">
        <label class="block font-semibold mb-1">Texte</label>
        <textarea name="content_text" rows="5" class="w-full border p-2 rounded"><?= htmlspecialchars($currentContent['text'] ?? ''); ?></textarea>
      </div>

      <!-- Champ image -->
      <div class="mb-4">
        <label class="block font-semibold mb-1">Image (optionnel)</label>
        <input type="file" name="content_image" class="w-full border p-2 rounded">
        <?php if (!empty($currentContent['image'])): ?>
          <p class="text-sm text-gray-500 mt-2">
            Image actuelle : 
            <a href="<?= htmlspecialchars($currentContent['image']); ?>" target="_blank" class="underline">
              Voir l'image
            </a>
          </p>
        <?php endif; ?>
      </div>

      <!-- Boutons -->
      <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Enregistrer</button>
      <a href="index.php?action=admin_dashboard" class="ml-4 text-blue-600 hover:underline">Annuler</a>
    </form>
  </div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
