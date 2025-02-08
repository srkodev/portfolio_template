<?php
$title = $editing ? "Modifier la compétence" : "Ajouter une compétence";
require __DIR__ . '/../includes/header.php';
?>
<section class="bg-white py-16">
    <div class="max-w-3xl mx-auto px-4 fade-in">
        <h1 class="text-2xl font-bold mb-4">
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
                    <label class="block font-semibold mb-1">Titre</label>
                    <input
                        type="text"
                        name="title"
                        class="w-full border border-gray-300 p-2 rounded"
                        value="<?= htmlspecialchars($competence['title'] ?? '') ?>"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Description</label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 p-2 rounded"
                        required
                    ><?= htmlspecialchars($competence['description'] ?? '') ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Icône (SVG uniquement)</label>
                    <input
                        type="file"
                        name="iconFile"
                        accept=".svg,image/svg+xml"
                        class="w-full border border-gray-300 p-2 rounded"
                        <?= $editing ? '' : 'required' ?>
                    />
                    <?php if ($editing && !empty($competence['icon'])): ?>
                        <p class="text-sm text-gray-600 mt-2">
                            Icône actuelle :
                            <a href="<?= htmlspecialchars($competence['icon']) ?>" target="_blank" class="underline">
                                Voir l'icône
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Boutons -->
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Enregistrer
            </button>
            <a href="index.php?action=admin_competences_list" class="ml-4 text-blue-600 hover:underline">Annuler</a>
            <a
                href="index.php?action=home"
                class="ml-4 text-blue-600 hover:underline"
            >
                Site Principal
            </a>
        </form>
    </div>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
