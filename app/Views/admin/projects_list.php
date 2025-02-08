<?php
$title = "projet-list";
require __DIR__ . '/../includes/header.php';
?>

    <!-- HERO Liste Projets -->
    <section
      class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-fuchsia-600 via-purple-700 to-indigo-800"
    >
      <div class="absolute inset-0 bg-black bg-opacity-30"></div>
      <div class="relative z-10 text-center text-white px-4 fade-in">
        <h1 class="text-4xl sm:text-5xl font-bold mb-6 drop-shadow-lg">
          Gérer les Projets
        </h1>
        <p class="text-xl sm:text-2xl drop-shadow-md">
          Ajouter, éditer ou supprimer vos projets
        </p>
      </div>
      <!-- Wave -->
      <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
        <svg
          class="relative block w-full h-20"
          xmlns="http://www.w3.org/2000/svg"
          preserveAspectRatio="none"
          viewBox="0 0 1200 120"
        >
          <path
            d="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z"
            fill="#FFFFFF"
          />
        </svg>
      </div>
    </section>

    <!-- SECTION TABLE DES PROJETS -->
    <section class="bg-white py-16 -mt-1" style="clip-path: polygon(0 0, 100% 5%, 100% 100%, 0 100%)">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-indigo-600">Liste des Projets</h2>
          <a
            href="index.php?action=admin_project_form"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
          >
            Ajouter un projet
          </a>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse shadow-lg">
            <thead class="bg-indigo-100">
              <tr>
                <th class="py-3 px-4 text-indigo-900 font-semibold">ID</th>
                <th class="py-3 px-4 text-indigo-900 font-semibold">Titre</th>
                <th class="py-3 px-4 text-indigo-900 font-semibold">Description</th>
                <th class="py-3 px-4 text-indigo-900 font-semibold">Image</th>
                <th class="py-3 px-4 text-indigo-900 font-semibold">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php foreach($projects as $proj): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-3 px-4"><?= $proj['id'] ?></td>
                  <td class="py-3 px-4"><?= htmlspecialchars($proj['title']) ?></td>
                  <td class="py-3 px-4"><?= htmlspecialchars($proj['description']) ?></td>
                  <td class="py-3 px-4">
                    <?php if (!empty($proj['image'])): ?>
                      <img src="<?= htmlspecialchars($proj['image']) ?>" alt="Image <?= htmlspecialchars($proj['title']) ?>" class="w-16 h-16 object-cover rounded">
                    <?php else: ?>
                      <span class="text-gray-500">Aucune image</span>
                    <?php endif; ?>
                  </td>
                  <td class="py-3 px-4 space-x-2">
                    <a
                      href="index.php?action=admin_project_form&id=<?= $proj['id'] ?>"
                      class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition"
                    >
                      Éditer
                    </a>
                    <a
                      href="index.php?action=admin_project_delete&id=<?= $proj['id'] ?>"
                      class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition"
                      onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?')"
                    >
                      Supprimer
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($projects)): ?>
                <tr>
                  <td colspan="5" class="py-4 px-4 text-center text-gray-500">Aucun projet trouvé.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div class="mt-6">
          <a
            href="index.php?action=admin_dashboard"
            class="text-indigo-600 hover:underline"
          >
            Retour Dashboard
          </a>
        </div>
      </div>
    </section>

    <?php require __DIR__ . '/../includes/footer.php';  ?>
