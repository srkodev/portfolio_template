<?php
$title = "Accueil - Portfolio";
require __DIR__ . '/../includes/header.php';
?>

<!--
    HOME.PHP
    Structure générale:
    - Une nav latérale fixe (voir header.php)
    - Un wrapper principal (div) pour que toutes les sections se décalent à droite
    - Sections : Hero / About / Projects / Skills / Contact
-->

<div class="ml-0 md:ml-64 transition-all duration-300">
  <!-- HERO SECTION -->
  <section id="accueil" class="relative min-h-screen flex items-center bg-gradient-to-br from-[#0f2027] via-[#203a43] to-[#2c5364]">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-10 lg:py-16 flex flex-col md:flex-row items-center justify-between gap-10">
      <!-- Texte de Présentation -->
      <div class="text-white w-full md:w-1/2 space-y-6 fade-in">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
          Bonjour, je suis <span class="text-[#00ffd9]">Alexandre</span>
        </h1>
        <p class="text-base sm:text-lg lg:text-xl max-w-xl">
          Étudiant en BUT MMI (Création & Communication numérique). Passionné par le développement web et la création numérique, j'aime concevoir des expériences uniques et innovantes.
        </p>
        <a 
          href="#apropos"
          class="inline-block bg-[#00ffd9] text-gray-800 font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl hover:bg-teal-200 transition-transform hover:-translate-y-1"
        >
          En savoir plus
        </a>
      </div>

      <!-- Image / Illustration -->
      <div class="w-full md:w-1/2 flex justify-center fade-in">
        <img 
          src="https://images.unsplash.com/photo-1587614382359-bf92ecde8ad4" 
          alt="Hero Illustration" 
          class="max-h-96 rounded-xl shadow-2xl object-cover"
        />
      </div>
    </div>
  </section>

  <!-- SECTION A PROPOS -->
  <section id="apropos" class="bg-white py-16 lg:py-20">
    <div class="max-w-6xl mx-auto px-6 fade-in">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Image -->
        <div class="order-2 md:order-1 flex justify-center">
          <img
            src="<?= !empty($aboutMe['image']) ? htmlspecialchars($aboutMe['image']) : 'https://via.placeholder.com/400x400'; ?>"
            alt="Portrait de Alexandre"
            class="rounded-xl w-64 h-64 sm:w-80 sm:h-80 object-cover shadow-2xl"
          />
        </div>
        <!-- Texte -->
        <div class="order-1 md:order-2">
          <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6">
            À propos de moi
          </h2>
          <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-6">
            <?= isset($aboutMe['text']) ? nl2br(htmlspecialchars($aboutMe['text'])) : ''; ?>
          </p>
          <a
            href="#projets"
            class="inline-block bg-gray-900 text-white font-semibold px-5 py-3 rounded-full hover:bg-gray-800 transition-transform hover:-translate-y-1"
          >
            Découvrir mes projets
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION PROJETS -->
  <section id="projets" class="bg-gradient-to-b from-gray-100 to-white py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-6 fade-in">
      <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-900 mb-12">
        Mes Projets
      </h2>
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($projects as $proj): ?>
          <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition p-4 flex flex-col">
            <?php if (!empty($proj['image'])): ?>
              <img
                src="<?= htmlspecialchars($proj['image']) ?>"
                alt="Projet"
                class="w-full h-40 object-cover rounded-md mb-4"
              />
            <?php else: ?>
              <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-md mb-4">
                <span class="text-gray-500">Aucune image</span>
              </div>
            <?php endif; ?>
            <h3 class="text-lg font-bold mb-2 text-gray-800">
              <?= htmlspecialchars($proj['title']) ?>
            </h3>
            <p class="text-gray-600 flex-grow">
              <?= htmlspecialchars($proj['description']) ?>
            </p>
            <div class="mt-4">
              <a
                href="index.php?action=project_detail&id=<?= $proj['id'] ?>"
                class="inline-block text-[#0ea5e9] font-semibold hover:underline"
              >
                Voir le projet
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SECTION COMPETENCES -->
  <section id="competences" class="bg-white py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-6 fade-in">
      <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-900 mb-12">
        Mes Compétences
      </h2>
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($competences as $comp): ?>
          <div class="rounded-lg shadow p-6 bg-gradient-to-r from-gray-50 via-white to-gray-50 hover:shadow-xl transition">
            <?php if (!empty($comp['icon'])): ?>
              <div class="flex justify-center mb-4">
                <img
                  src="<?= htmlspecialchars($comp['icon']) ?>"
                  alt="Icône"
                  class="w-12 h-12 object-contain"
                />
              </div>
            <?php endif; ?>
            <h3 class="text-xl font-bold text-center mb-2 text-gray-800">
              <?= htmlspecialchars($comp['title']) ?>
            </h3>
            <p class="text-gray-700 text-center">
              <?= htmlspecialchars($comp['description']) ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SECTION CONTACT -->
  <section id="contact" class="bg-gradient-to-t from-[#0f2027] via-[#203a43] to-[#2c5364] py-16 lg:py-20 text-white">
    <div class="max-w-5xl mx-auto px-6 fade-in">
      <h2 class="text-3xl sm:text-4xl font-extrabold text-center mb-6">
        Me Contacter
      </h2>
      <p class="text-center max-w-2xl mx-auto mb-10 text-gray-200">
        Pour toutes questions, n'hésitez pas à me contacter via ce formulaire !
      </p>
      <div class="bg-white bg-opacity-10 rounded-lg p-6 sm:p-8 shadow-2xl max-w-3xl mx-auto">
        <form action="index.php?action=handle_contact_form" method="POST" class="space-y-6">
          <!-- Message d'erreur ou de succès -->
          <?php if (!empty($error)): ?>
            <p class="text-red-300 text-center mb-4">
              <?= htmlspecialchars($error); ?>
            </p>
          <?php endif; ?>
          <?php if (!empty($success)): ?>
            <p class="text-green-300 text-center mb-4">
              <?= htmlspecialchars($success); ?>
            </p>
          <?php endif; ?>

          <!-- Champ Nom -->
          <div>
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input 
              type="text"
              id="nom"
              name="nom"
              value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-400 text-gray-800"
              required
            />
          </div>

          <!-- Champ Email -->
          <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input 
              type="email"
              id="email"
              name="email"
              value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-400 text-gray-800"
              required
            />
          </div>

          <!-- Champ Message -->
          <div>
            <label for="message" class="block font-semibold mb-1">Message</label>
            <textarea
              id="message"
              name="message"
              rows="5"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-400 text-gray-800"
              required
            ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>

          <!-- CAPTCHA -->
          <div class="flex justify-center">
            <div class="cf-turnstile" data-sitekey="0x4AAAAAAA589g-2YAeWNvwG"></div>
          </div>

          <!-- Bouton d'envoi -->
          <button
            type="submit"
            class="w-full bg-[#00ffd9] text-gray-900 px-6 py-3 rounded-full shadow-md hover:shadow-xl font-semibold transition-transform hover:-translate-y-0.5"
          >
            Envoyer
          </button>
        </form>
      </div>
    </div>
  </section>

</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
