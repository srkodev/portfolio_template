<footer class="bg-indigo-800 text-white py-8">
  <div class="max-w-7xl mx-auto px-4 text-center">
    &copy; <?= date('Y'); ?> - Portfolio Jules Crevoisier. Tous droits réservés.
  </div>
</footer>

<!-- Script : header transparent -> coloré on scroll -->
<script>
  window.addEventListener("scroll", function () {
    const header = document.getElementById("header");
    if (window.scrollY > 50) {
      header.classList.add("bg-indigo-900", "bg-opacity-80", "shadow-md");
    } else {
      header.classList.remove("bg-indigo-900", "bg-opacity-80", "shadow-md");
    }
  });
</script>

<!-- Script : scroll fluide sur liens #... -->
<script>
  document.querySelectorAll('a[href^="#"]').forEach((lien) => {
    lien.addEventListener("click", function (e) {
      e.preventDefault();
      const sectionCible = document.querySelector(this.getAttribute("href"));
      if (sectionCible) {
        sectionCible.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });
</script>
</body>
</html>
