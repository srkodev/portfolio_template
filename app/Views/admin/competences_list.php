<?php
$title = "Compétances-list";
require __DIR__ . '/../includes/header.php';
?>

<!-- HERO Liste Compétences -->
<section class="relative flex items-center justify-center min-h-[40vh]" data-aos="fade-up">
  <div class="relative z-10 text-center px-4 fade-in">
    <h1 class="text-4xl sm:text-5xl font-bold mb-6 drop-shadow-lg text-gray-900 dark:text-white">
      Gérer les Compétences
    </h1>
    <p class="text-xl sm:text-2xl drop-shadow-md text-gray-700 dark:text-gray-300">
      Ajouter, éditer ou supprimer vos compétences
    </p>
  </div>
</section>

<!-- SECTION TABLE DES COMPÉTENCES -->
<section class="py-16" data-aos="fade-up">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 fade-in bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold text-indigo-600">Liste des Compétences</h2>
      <a href="index.php?action=admin_competence_form"
         class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
         Ajouter une compétence
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse shadow-lg">
        <thead class="bg-indigo-100 dark:bg-gray-700">
          <tr>
            <th class="py-3 px-4 text-indigo-900 dark:text-indigo-200 font-semibold">ID</th>
            <th class="py-3 px-4 text-indigo-900 dark:text-indigo-200 font-semibold">Titre</th>
            <th class="py-3 px-4 text-indigo-900 dark:text-indigo-200 font-semibold">Description</th>
            <th class="py-3 px-4 text-indigo-900 dark:text-indigo-200 font-semibold">Icône</th>
            <th class="py-3 px-4 text-indigo-900 dark:text-indigo-200 font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800">
          <?php foreach($competences as $comp): ?>
            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
              <td class="py-3 px-4"><?= $comp['id'] ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($comp['title']) ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($comp['description']) ?></td>
              <td class="py-3 px-4">
                <?php if (!empty($comp['icon'])): ?>
                  <img src="<?= htmlspecialchars($comp['icon']) ?>" alt="Icône <?= htmlspecialchars($comp['title']) ?>" class="w-8 h-8">
                <?php else: ?>
                  <span class="text-gray-500">Aucune icône</span>
                <?php endif; ?>
              </td>
              <td class="py-3 px-4 space-x-2">
                <a href="index.php?action=admin_competence_form&id=<?= $comp['id'] ?>"
                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                  Éditer
                </a>
                <a href="index.php?action=admin_competence_delete&id=<?= $comp['id'] ?>"
                   class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition"
                   onclick="return confirm('Voulez-vous vraiment supprimer cette compétence ?')">
                  Supprimer
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($competences)): ?>
            <tr>
              <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                Aucune compétence trouvée.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      <a href="index.php?action=admin_dashboard" class="text-indigo-600 hover:underline">
        Retour Dashboard
      </a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
