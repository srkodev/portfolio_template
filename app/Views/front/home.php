<?php
$title = "Accueil - Portfolio";
require __DIR__ . '/../includes/header.php';
?>

  <!-- HERO SECTION -->
  <section
    id="accueil"
    class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-fuchsia-600 via-purple-700 to-indigo-800 text-white"
  >
    <!-- Overlay sombre -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>

    <div class="relative z-10 text-center p-4 fade-in">
      <h1 class="text-4xl sm:text-6xl font-bold mb-6 leading-tight drop-shadow-lg">
        Bonjour, je suis <span class="text-indigo-100">Jules</span>
      </h1>
      <p class="text-xl sm:text-2xl mb-6 drop-shadow-md">
        Développeur & Étudiant en MMI
      </p>
      <a
        href="#apropos"
        class="bg-white text-indigo-600 px-6 py-2 rounded font-semibold shadow hover:shadow-lg transition transform hover:-translate-y-1"
      >
        En savoir plus
      </a>
    </div>

    <!-- Vague en bas du Hero -->
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

  <!-- SECTION A PROPOS (lit $aboutMe depuis la DB) -->
<!-- SECTION A PROPOS -->
<section
  id="apropos"
  class="bg-white py-16 -mt-1"
  style="clip-path: polygon(0 0, 100% 5%, 100% 100%, 0 100%)"
>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      <!-- Texte -->
      <div class="order-2 md:order-1 fade-in">
        <h2 class="text-3xl sm:text-4xl font-bold text-indigo-600 mb-6">
          À propos de moi
        </h2>
        <!-- Affiche le contenu de $aboutMe -->
        <p class="text-gray-700 text-lg leading-relaxed mb-4">
          <?= isset($aboutMe['text']) ? nl2br(htmlspecialchars($aboutMe['text'])) : ''; ?>
        </p>
        <a
          href="#projets"
          class="inline-block bg-indigo-600 text-white font-semibold px-6 py-3 rounded-full shadow hover:bg-indigo-700 transition transform hover:-translate-y-1"
        >
          Découvrir mes projets
        </a>
      </div>
      <!-- Image -->
      <div class="order-1 md:order-2 flex justify-center fade-in">
        <img
          src="<?= !empty($aboutMe['image']) ? htmlspecialchars($aboutMe['image']) : 'https://via.placeholder.com/350x350'; ?>"
          alt="Portrait de Jules"
          class="rounded-full w-72 h-72 object-cover shadow-xl"
        />
      </div>
    </div>
  </div>
</section>
  <!-- SECTION PROJETS (lit $projects depuis la DB) -->
  <section id="projets" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl sm:text-4xl font-bold text-center text-indigo-600 mb-12 fade-in">
        Mes Projets
      </h2>
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 fade-in">
        <?php foreach ($projects as $proj): ?>
          <div
            class="group relative overflow-hidden bg-white shadow-lg rounded-lg hover:shadow-2xl transform transition hover:-translate-y-1"
          >
            <?php if (!empty($proj['image'])): ?>
              <img
                src="<?= htmlspecialchars($proj['image']) ?>"
                alt="Projet"
                class="w-full h-48 object-cover"
              />
            <?php endif; ?>
            <div class="p-6 relative z-10">
              <h3 class="text-xl font-semibold mb-2 group-hover:text-indigo-600 transition">
                <?= htmlspecialchars($proj['title']) ?>
              </h3>
              <p class="text-gray-600 mb-4">
                <?= htmlspecialchars($proj['description']) ?>
              </p>
              <a
                href="index.php?action=project_detail&id=<?= $proj['id'] ?>"
                class="text-indigo-600 font-semibold hover:underline"
              >
                Voir le projet
              </a>
            </div>
            <div
              class="absolute inset-0 bg-indigo-600 bg-opacity-0 group-hover:bg-opacity-20 transition pointer-events-none"
            ></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

<!-- SECTION COMPETENCES -->
<section id="competences" class="py-16 bg-gray-50">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl sm:text-4xl font-bold text-center text-indigo-600 mb-12">
      Mes Compétences
    </h2>
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($competences as $comp): ?>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <!-- Icone -->
        <?php if (!empty($comp['icon'])): ?>
          <img
            src="<?= htmlspecialchars($comp['icon']) ?>"
            alt="Icône de la compétence"
            class="mx-auto mb-4 w-10 h-10"
          />
        <?php endif; ?>

        <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($comp['title']) ?></h3>
        <p class="text-gray-700"><?= htmlspecialchars($comp['description']) ?></p>
        </div>
    <?php endforeach; ?>
    </div>
  </div>
</section>
  <!-- SECTION CONTACT -->
  <section
  id="contact"
  class="relative bg-white py-20"
  style="clip-path: polygon(0 0, 100% 10%, 100% 100%, 0 100%)"
>
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl sm:text-4xl font-bold text-center text-indigo-600 mb-8 fade-in">
      Me Contacter
    </h2>
    <p class="text-center text-gray-700 max-w-2xl mx-auto mb-12 fade-in">
      Vous avez un projet, une question ou simplement envie de discuter ? 
      Envoyez-moi un message et je vous répondrai au plus vite.
    </p>
    <div class="bg-gray-50 shadow-lg rounded-lg p-8 fade-in">
    <form action="index.php?action=handle_contact_form" method="POST" class="space-y-6">
        <!-- Messages d'erreur ou de succès -->
        <?php if (!empty($error)): ?>
            <p class="text-red-600 text-center mb-4"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="text-green-600 text-center mb-4"><?= htmlspecialchars($success); ?></p>
        <?php endif; ?>

        <!-- Champ Nom -->
        <div>
            <label for="nom" class="block text-gray-700 font-semibold mb-1">Nom</label>
            <input 
                type="text" 
                id="nom" 
                name="nom" 
                value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md" 
                required 
            />
        </div>

        <!-- Champ Email -->
        <div>
            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md" 
                required 
            />
        </div>

        <!-- Champ Message -->
        <div>
            <label for="message" class="block text-gray-700 font-semibold mb-1">Message</label>
            <textarea 
                id="message" 
                name="message" 
                rows="5" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md" 
                required
            ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        </div>

        <!-- CAPTCHA -->
        <div class="cf-turnstile" data-sitekey="0x4AAAAAAA589g-2YAeWNvwG"></div>

        <!-- Bouton d'envoi -->
        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-full shadow hover:bg-indigo-700">
            Envoyer
        </button>
    </form>

    </div>
  </div>
</section>


  <?php require __DIR__ . '/../includes/footer.php';  ?>
