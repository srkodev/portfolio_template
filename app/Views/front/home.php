<?php
$title = "Accueil - Portfolio";
require __DIR__ . '/../includes/header.php';
?>

<!-- HERO SECTION -->
<section
  id="accueil"
  class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-fuchsia-600 via-purple-700 to-indigo-800 text-white px-4"
>
  <!-- Overlay sombre -->
  <div class="absolute inset-0 bg-black bg-opacity-30"></div>

  <div class="relative z-10 text-center p-4 fade-in">
    <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-6 leading-tight drop-shadow-lg">
      Bonjour, je suis <span class="text-indigo-100">Alexandre</span>
    </h1>
    <p class="text-md sm:text-lg md:text-2xl mb-6 drop-shadow-md">
      Étudiant en BUT MMI Création et Communication numérique
    </p>
    <a
      href="#apropos"
      class="bg-white text-indigo-600 px-4 sm:px-6 py-2 sm:py-3 rounded font-semibold shadow hover:shadow-lg transition transform hover:-translate-y-1 inline-block"
    >
      En savoir plus
    </a>
  </div>

  <!-- Vague en bas du Hero -->
  <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
    <svg
      class="relative block w-full h-16 sm:h-20"
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

<!-- SECTION A PROPOS -->
<section
  id="apropos"
  class="bg-white py-12 -mt-1 sm:py-16 -mt-1"
>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
      <!-- Image -->
      <div class="flex justify-center fade-in order-1 md:order-2">
        <img
          src="<?= !empty($aboutMe['image']) ? htmlspecialchars($aboutMe['image']) : 'https://via.placeholder.com/350x350'; ?>"
          alt="Portrait de Alexandre"
          class="rounded-full w-48 h-48 sm:w-60 sm:h-60 md:w-72 md:h-72 object-cover shadow-xl"
        />
      </div>
      <!-- Texte -->
      <div class="fade-in order-2 md:order-1 md:text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-indigo-600 mb-4 sm:mb-6">
          À propos de moi
        </h2>
        <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-4">
          <?= isset($aboutMe['text']) ? nl2br(htmlspecialchars($aboutMe['text'])) : ''; ?>
        </p>
        <a
          href="index.php?action=home#projets"
          class="inline-block bg-indigo-600 text-white font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-full shadow hover:bg-indigo-700 transition transform hover:-translate-y-1 mx-auto sm:mx-0"
        >
          Découvrir mes projets
        </a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION PROJETS -->
<section id="projets" class="py-12 sm:py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center text-indigo-600 mb-8 sm:mb-12 fade-in">
      Mes Projets
    </h2>
    <div class="grid gap-6 sm:gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 fade-in">
      <?php foreach ($projects as $proj): ?>
        <div
          class="group relative overflow-hidden bg-white shadow-lg rounded-lg hover:shadow-2xl transform transition hover:-translate-y-1"
        >
          <?php if (!empty($proj['image'])): ?>
            <img
              src="<?= htmlspecialchars($proj['image']) ?>"
              alt="Projet"
              class="w-full h-32 sm:h-48 object-cover"
            />
          <?php endif; ?>
          <div class="p-4 sm:p-6 relative z-10">
            <h3 class="text-lg sm:text-xl font-semibold mb-2 group-hover:text-indigo-600 transition">
              <?= htmlspecialchars($proj['title']) ?>
            </h3>
            <p class="text-gray-600 text-sm sm:text-base mb-4">
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
<section id="competences" class="py-12 sm:py-16 bg-gray-50">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center text-indigo-600 mb-8 sm:mb-12">
      Mes Compétences
    </h2>
    <div class="grid gap-6 sm:gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($competences as $comp): ?>
        <div class="bg-white rounded-lg shadow p-6 text-center">
          <!-- Icône -->
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
  class="relative bg-white py-12 sm:py-20"
  style="clip-path: polygon(0 0, 100% 10%, 100% 100%, 0 100%)"
>
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center text-indigo-600 mb-6 sm:mb-8 fade-in">
      Me Contacter
    </h2>
    <p class="text-center text-gray-700 max-w-2xl mx-auto mb-8 sm:mb-12 fade-in">
      Pour toutes questions, n'hésitez pas à me contacter via ce formulaire !
    </p>
    <div class="bg-gray-50 shadow-lg rounded-lg p-6 sm:p-8 fade-in">
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
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" 
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
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" 
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
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" 
            required
          ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        </div>

        <!-- CAPTCHA -->
        <div class="flex justify-center">
          <div class="cf-turnstile" data-sitekey="0x4AAAAAAA589g-2YAeWNvwG"></div>
        </div>

        <!-- Bouton d'envoi -->
        <button type="submit" class="w-full bg-indigo-600 text-white px-4 sm:px-6 py-3 rounded-full shadow hover:bg-indigo-700 transition">
          Envoyer
        </button>
      </form>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
