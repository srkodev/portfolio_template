<?php
$title = "Accueil - Portfolio";
require __DIR__ . '/../includes/header.php';
?>

<!-- SECTION HERO (À PROPOS) -->
<section id="apropos" class="container mx-auto px-4 py-16 flex flex-col md:flex-row items-center gap-10" data-aos="fade-up">
  <!-- Texte d'introduction -->
  <div class="md:w-1/2 space-y-6">
    <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
      Bonjour, je suis Jules Crevoisier.
    </h1>
    <p class="text-xl md:text-2xl opacity-80">
      <?= isset($aboutMe['text']) ? nl2br(htmlspecialchars($aboutMe['text'])) : "Développeur web passionné."; ?>
    </p>
    <div class="flex space-x-4">
      <!-- Boutons sociaux dans le hero -->
      <a href="https://x.com/srko_dj" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-full 
                       hover:bg-gray-200 dark:hover:bg-gray-700 transition"
         aria-label="Twitter">
        <!-- Icône Twitter -->
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.26 4.26 0 001.88-2.35 
                   8.38 8.38 0 01-2.7 1.03 4.2 4.2 0 00-7.18 3.83 
                   11.92 11.92 0 01-8.65-4.38 4.19 4.19 0 001.3 5.6 
                   A4.2 4.2 0 012 9.7v.05a4.2 4.2 0 003.36 4.11 
                   4.2 4.2 0 01-1.88.07 4.2 4.2 0 003.92 2.91 
                   A8.42 8.42 0 012 19.54 11.87 11.87 0 008.29 21 
                   c7.55 0 11.68-6.26 11.68-11.68 0-.18-.01-.35-.02-.53 
                   A8.36 8.36 0 0022.46 6z"/>
        </svg>
      </a>
      <a href="#" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-full 
                       hover:bg-gray-200 dark:hover:bg-gray-700 transition"
         aria-label="LinkedIn">
        <!-- Icône LinkedIn -->
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512">
          <path d="M100.28 448H7.4V148.9h92.88zm-46.44-341C24.09 107 
                   0 82.91 0 53.72A53.72 53.72 0 1153.72 107 
                   c0 29.19-24.09 53.28-53.72 53.28zM447.9 448H355.22V302.4
                   c0-34.69-12.44-58.38-43.51-58.38-23.75 0-37.86 15.95-44.14 31.37
                   -2.28 5.6-2.85 13.36-2.85 21.23V448H172.04s1.24-261.26 
                   0-288.13h92.68v40.82a92 92 0 0184-45.9
                   c61.24 0 107.18 39.94 107.18 125.68V448z"/>
        </svg>
      </a>
      <a href="https://github.com/srkodev" target="_blank" class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-full 
                       hover:bg-gray-200 dark:hover:bg-gray-700 transition"
         aria-label="GitHub">
        <!-- Icône GitHub -->
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 496 512">
          <path d="M165.9 397.4c0 2-2.3 3.7-5.2 3.7-2.9 0-5.2-1.7-5.2-3.7 
                   0-2 2.3-3.7 5.2-3.7 2.9 0 5.2 1.7 5.2 3.7zm-26.5-6.2
                   c-.7 2.1 1.5 4.4 4.2 5.1 2.8.7 5.8-.3 6.5-2.4
                   .7-2.1-1.5-4.4-4.2-5.1-2.8-.7-5.8.3-6.5 2.4zm26.6-4.9
                   c-2.9.8-4.9 3.1-4.2 5.2.7 2.1 3.4 3.2 6.3 2.4 
                   2.9-.8 4.9-3.1 4.2-5.2-.7-2.1-3.4-3.2-6.3-2.4zM248 8
                   C111 8 0 119 0 256c0 110.59 71.64 203.62 170.9 237.09 
                   12.47 2.3 17.02-5.41 17.02-12v-43.49
                   c-69.47 15.09-84.12-33.52-84.12-33.52
                   -11.36-28.88-27.76-36.58-27.76-36.58
                   -22.68-15.52 1.71-15.21 1.71-15.21
                   25.1 1.77 38.26 25.78 38.26 25.78
                   22.28 38.24 58.4 27.2 72.67 20.79
                   2.24-16.15 8.74-27.2 15.93-33.47
                   -55.48-6.31-113.83-27.74-113.83-123.44
                   0-27.27 9.68-49.59 25.58-67
                   -2.58-6.31-11.07-31.73 2.44-66.2
                   0 0 20.86-6.68 68.38 25.51
                   a236.67 236.67 0 01125.07 0
                   c47.46-32.22 68.34-25.51 68.34-25.51
                   13.54 34.47 5 59.89 2.43 66.2
                   15.94 17.48 25.55 39.8 25.55 67
                   0 95.88-58.39 117-113.98 123.17
                   9 7.76 17 22.98 17 46.33v68.72
                   c0 6.63 4.48 14.42 17.12 11.97
                   C424.36 459.59 496 366.56 496 256
                   496 119 385 8 248 8z"/>
        </svg>
      </a>
    </div>
  </div>

  <!-- Image du hero -->
  <div class="md:w-1/2 flex justify-center" data-aos="fade-left">
    <div class="relative mx-auto">
      <img src="<?= !empty($aboutMe['image']) 
          ? htmlspecialchars($aboutMe['image']) 
          : 'https://via.placeholder.com/500?text=Portrait'; ?>" 
           alt="Portrait Jules Crevoisier" 
           class="w-[250px] h-[250px] rounded-full border-4 border-gray-200 dark:border-gray-600" />
      <!-- Cercles décoratifs statiques -->
      <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
        <div class="absolute w-[500px] h-[500px] md:w-80 md:h-80 border border-gray-300 dark:border-gray-500 rounded-full"></div>
        <div class="absolute w-[550px] h-[550px] md:w-96 md:h-96 border border-gray-300 dark:border-gray-500 opacity-50 rounded-full"></div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION PROJETS -->
<section id="projects" class="container mx-auto px-4 py-16" data-aos="fade-up">
  <h2 class="text-4xl font-bold mb-12 text-center">Mes Projets</h2>
  <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($projects as $proj): ?>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl 
                  transform hover:-translate-y-1 transition p-4 flex flex-col 
                  border border-gray-200 dark:border-gray-700">
        <?php if (!empty($proj['image'])): ?>
          <img src="<?= htmlspecialchars($proj['image']) ?>" 
               alt="Projet" 
               class="w-full h-40 object-cover rounded-md mb-4" />
        <?php else: ?>
          <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-md mb-4">
            <span class="text-gray-500">Aucune image</span>
          </div>
        <?php endif; ?>
        <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-300">
          <?= htmlspecialchars($proj['title']) ?>
        </h3>
        <p class="text-gray-600 dark:text-gray-300 flex-grow">
          <?= htmlspecialchars($proj['description']) ?>
        </p>
        <div class="mt-4">
          <a href="index.php?action=project_detail&id=<?= $proj['id'] ?>" 
             class="inline-block bg-blue-500 text-white font-bold px-4 py-2 rounded 
                    hover:bg-blue-600 transition">
            Voir le projet
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- SECTION COMPÉTENCES -->
<section id="skills" class="container mx-auto px-4 py-16" data-aos="fade-right">
  <h2 class="text-4xl font-bold mb-12 text-center">Compétences</h2>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    <?php foreach ($competences as $comp): ?>
      <span class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 
                   text-gray-700 dark:text-gray-300 text-sm py-2 px-4 
                   rounded-lg shadow-md cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
        <div class="flex items-center space-x-4">
          <!-- Icône / SVG -->
          <img src="<?= htmlspecialchars($comp['icon']) ?>" 
               alt="<?= htmlspecialchars($comp['title']) ?>" 
               class="h-6 w-6">
          <!-- Nom de la compétence -->
          <span><?= htmlspecialchars($comp['title']) ?></span>
        </div>
      </span>
    <?php endforeach; ?>
  </div>
</section>

<!-- SECTION CONTACT -->
<section id="contact" class="container mx-auto px-4 py-16" data-aos="fade-up">
  <h3 class="text-3xl font-bold mb-8 text-center">Me contacter</h3>
  
  <div class="flex flex-col md:flex-row items-center gap-8">
    <!-- Formulaire de contact -->
    <div class="w-full md:w-1/2">
      <!-- Remplacez l'action par la route gérant votre formulaire -->
      <form action="index.php?action=handle_contact_form" method="POST" class="space-y-4">
        
        <!-- Affichage du message d'erreur si présent -->
        <?php if (!empty($error)): ?>
          <p class="text-red-600 text-center mb-4">
            <?= htmlspecialchars($error); ?>
          </p>
        <?php endif; ?>
        
        <!-- Le message de succès est désormais affiché dans le modal -->
        
        <!-- Champ Nom (ou Nom / Entreprise) -->
        <div>
          <label for="nom" class="block mb-1">Nom ou entreprise</label>
          <input
            type="text"
            id="nom"
            name="nom"
            placeholder="Votre nom ou entreprise"
            value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
            required
            class="w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                   rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Champ Email -->
        <div>
          <label for="email" class="block mb-1">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="jules.crevoisier@example.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            required
            class="w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                   rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- Champ Message -->
        <div>
          <label for="message" class="block mb-1">Message</label>
          <textarea
            id="message"
            name="message"
            rows="5"
            placeholder="Votre message ici..."
            required
            class="w-full px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                   rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        </div>

        <!-- CAPTCHA Turnstile (ou reCAPTCHA, selon votre choix) -->
        <div class="flex justify-center">
          <div class="cf-turnstile" data-sitekey="0x4AAAAAAA8N842mHAZW49A8"></div>
        </div>
        
        <!-- Bouton d'envoi -->
        <div>
          <button
            type="submit"
            id="send"
            class="bg-blue-500 text-white font-bold px-4 py-2 rounded hover:bg-blue-600 
                   transition w-full"
          >
            Envoyer
          </button>
        </div>
      </form>
    </div>
    
    <!-- Séparateur entre le formulaire et les liens -->
    <div class="w-full md:w-auto">
      <div class="hidden md:block border-l border-gray-500 self-stretch"></div>
      <hr class="md:hidden border-t border-gray-500 w-full my-8">
    </div>
    
    <!-- Liens de contact avec fond décoratif -->
    <div class="w-full md:w-1/2 relative flex flex-col items-center justify-center bg-contain bg-center rounded-lg overflow-hidden" style="background-image: url('uploads/site/ppn.png'); min-height: 450px; background-repeat: no-repeat;">
      <div class="relative z-10 p-4">
        <p class="mb-4 text-lg font-semibold text-white">Vous pouvez aussi me retrouver ici</p>
        <div class="flex items-center space-x-4">
          <!-- Email -->
          <a href="mailto:crevoisier.ju@gmail.com"
             class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 
                    rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition"
             aria-label="Email">
            <!-- Icône Email -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M2.01 6.465c0-.55.447-1 .997-1h18.006c.55 0 .997.45.997 1v11.07c0 .55-.447 1-.997 1H3.008a1 1 0 01-.997-1V6.465zM12 12.995l9.007-5.53H2.993L12 12.995z" />
            </svg>
          </a>
          <!-- GitHub -->
          <a href="https://github.com/srkodev" target="_blank"
             class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 
                    rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition"
             aria-label="GitHub">
            <!-- Icône GitHub -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 496 512">
              <path d="M165.9 397.4c0 2-2.3 3.7-5.2 3.7-2.9 0-5.2-1.7-5.2-3.7 
                       0-2 2.3-3.7 5.2-3.7 2.9 0 5.2 1.7 5.2 3.7zm-26.5-6.2
                       c-.7 2.1 1.5 4.4 4.2 5.1 2.8.7 5.8-.3 6.5-2.4
                       .7-2.1-1.5-4.4-4.2-5.1-2.8-.7-5.8.3-6.5 2.4zm26.6-4.9
                       c-2.9.8-4.9 3.1-4.2 5.2.7 2.1 3.4 3.2 6.3 2.4 
                       2.9-.8 4.9-3.1 4.2-5.2-.7-2.1-3.4-3.2-6.3-2.4zM248 8
                       C111 8 0 119 0 256c0 110.59 71.64 203.62 170.9 237.09 
                       12.47 2.3 17.02-5.41 17.02-12v-43.49
                       c-69.47 15.09-84.12-33.52-84.12-33.52
                       -11.36-28.88-27.76-36.58-27.76-36.58
                       -22.68-15.52 1.71-15.21 1.71-15.21
                       25.1 1.77 38.26 25.78 38.26 25.78
                       22.28 38.24 58.4 27.2 72.67 20.79
                       2.24-16.15 8.74-27.2 15.93-33.47
                       -55.48-6.31-113.83-27.74-113.83-123.44
                       0-27.27 9.68-49.59 25.58-67
                       -2.58-6.31-11.07-31.73 2.44-66.2
                       0 0 20.86-6.68 68.38 25.51
                       a236.67 236.67 0 01125.07 0
                       c47.46-32.22 68.34-25.51 68.34-25.51
                       13.54 34.47 5 59.89 2.43 66.2
                       15.94 17.48 25.55 39.8 25.55 67
                       0 95.88-58.39 117-113.98 123.17
                       9 7.76 17 22.98 17 46.33v68.72
                       c0 6.63 4.48 14.42 17.12 11.97
                       C424.36 459.59 496 366.56 496 256
                       496 119 385 8 248 8z"/>
            </svg>
          </a>
          <!-- LinkedIn -->
          <a href="#"
             target="_blank"
             class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 
                    rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition"
             aria-label="LinkedIn">
            <!-- Icône LinkedIn -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512">
              <path d="M100.28 448H7.4V148.9h92.88zm-46.44-341C24.09 107 
                       0 82.91 0 53.72A53.72 53.72 0 1153.72 107 
                       c0 29.19-24.09 53.28-53.72 53.28zM447.9 448H355.22V302.4
                       c0-34.69-12.44-58.38-43.51-58.38-23.75 0-37.86 15.95-44.14 31.37
                       -2.28 5.6-2.85 13.36-2.85 21.23V448H172.04s1.24-261.26 
                       0-288.13h92.68v40.82a92 92 0 0184-45.9
                       c61.24 0 107.18 39.94 107.18 125.68V448z"/>
            </svg>
          </a>
          <!-- Discord -->
          <button type="button" id="discordButton"
                  class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 
                         rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                  aria-label="Discord">
            <!-- Icône Discord -->
            <svg xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <title>Discord</title>
              <path d="M20.317 4.369a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.211.375-.444.864-.608 1.249-1.844-.276-3.68-.276-5.486 0-.164-.385-.405-.874-.617-1.249a.077.077 0 00-.079-.037 19.736 19.736 0 00-4.885 1.515.07.07 0 00-.032.027C.533 9.045-.319 13.579.099 18.057a.082.082 0 00.031.055 19.9 19.9 0 005.993 3.03.077.077 0 00.084-.027c.461-.63.872-1.295 1.226-1.994a.076.076 0 00-.041-.105 13.22 13.22 0 01-1.872-.897.077.077 0 01-.008-.127c.125-.094.25-.192.371-.291a.074.074 0 01.077-.01c3.923 1.793 8.18 1.793 12.061 0a.074.074 0 01.078.009c.121.099.246.197.371.291a.077.077 0 01-.006.127 12.957 12.957 0 01-1.873.897.076.076 0 00-.04.106c.36.699.77 1.364 1.225 1.993a.077.077 0 00.084.028 19.913 19.913 0 005.993-3.03.077.077 0 00.031-.055c.5-5.177-.838-9.673-3.548-13.661a.061.061 0 00-.031-.028zM8.02 15.331c-1.182 0-2.148-1.085-2.148-2.419 0-1.333.955-2.418 2.148-2.418 1.21 0 2.175 1.08 2.148 2.418 0 1.334-.955 2.419-2.148 2.419zm7.974 0c-1.182 0-2.148-1.085-2.148-2.419 0-1.333.955-2.418 2.148-2.418 1.21 0 2.175 1.08 2.148 2.418 0 1.334-.938 2.419-2.148 2.419z"/>
            </svg>
          </button>
          <!-- Twitter -->
          <a href="https://x.com/srko_dj" target="_blank"
             class="w-12 h-12 flex items-center justify-center bg-gray-100 dark:bg-gray-800 
                    rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition"
             aria-label="Twitter">
            <!-- Icône Twitter -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.26 4.26 0 001.88-2.35 
                       8.38 8.38 0 01-2.7 1.03 4.2 4.2 0 00-7.18 3.83 
                       11.92 11.92 0 01-8.65-4.38 4.19 4.19 0 001.3 5.6 
                       A4.2 4.2 0 012 9.7v.05a4.2 4.2 0 003.36 4.11 
                       4.2 4.2 0 01-1.88.07 4.2 4.2 0 003.92 2.91 
                       A8.42 8.42 0 012 19.54 11.87 11.87 0 008.29 21 
                       c7.55 0 11.68-6.26 11.68-11.68 0-.18-.01-.35-.02-.53 
                       A8.36 8.36 0 0022.46 6z"/>
            </svg>
          </a>
        </div>
      </div>
      <!-- Overlay pour assombrir l'image de fond -->
      <div class="absolute inset-0 bg-black opacity-30"></div>
    </div>
  </div>
</section>

<!-- Modal pour Discord et confirmation d'envoi d'email avec style Glassmorphism -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white/30 dark:bg-gray-800/30 backdrop-blur-lg border border-white/40 rounded-lg p-6 max-w-sm w-full relative shadow-lg">
    <button id="modalClose" class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 text-2xl">&times;</button>
    <p id="modalMessage" class="text-center text-white"></p>
  </div>
</div>

<script>
  // Lors du clic sur le bouton Discord
  document.getElementById('discordButton').addEventListener('click', function() {
    const discordUsername = 'srko_gg';
    navigator.clipboard.writeText(discordUsername).then(function() {
      showModal("Nom d'utilisateur copié, ajoute-moi sur Discord");
    }, function(err) {
      console.error('Erreur lors de la copie: ', err);
    });
  });

  // Fonction d'affichage du modal avec un message
  function showModal(message) {
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('modal').classList.remove('hidden');
  }

  // Fermeture du modal au clic sur le bouton de fermeture
  document.getElementById('modalClose').addEventListener('click', function() {
    document.getElementById('modal').classList.add('hidden');
  });

  // Fermeture du modal en cliquant à l'extérieur du contenu
  document.getElementById('modal').addEventListener('click', function(e) {
    if(e.target === this) {
      document.getElementById('modal').classList.add('hidden');
    }
  });

  // Si un message de succès est défini (après envoi du formulaire), on affiche le modal
  <?php if (!empty($success)): ?>
    document.addEventListener('DOMContentLoaded', function() {
      showModal("<?= htmlspecialchars($success, ENT_QUOTES) ?>");
    });
  <?php endif; ?>
</script>

<?php
require __DIR__ . '/../includes/footer.php';
?>
