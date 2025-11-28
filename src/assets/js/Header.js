document.addEventListener("DOMContentLoaded", function () {
  const baseUrl = (window.headerData && window.headerData.baseUrl) || "/";

  // Animation fluide de la navigation
  document.querySelectorAll(".nav_item").forEach((item) => {
    item.addEventListener("click", function () {
      document.querySelectorAll(".nav_item").forEach((navItem) => {
        navItem.classList.remove("active");
      });
      this.classList.add("active");
    });
  });

  // Header sticky avec ombre au scroll
  let lastScrollTop = 0;
  const header = document.querySelector(".header");

  if (header) {
    window.addEventListener("scroll", () => {
      let st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > lastScrollTop && st > header.offsetHeight) {
        // Scroll vers le bas, cacher le header
        header.classList.add("hide");
      } else {
        // Scroll vers le haut, montrer le header
        header.classList.remove("hide");
      }
      lastScrollTop = st <= 0 ? 0 : st;
    });
  }

  // Gestion du bouton de connexion
  const connectBtn = document.querySelector(".header_connect-btn");
  if (connectBtn) {
    connectBtn.addEventListener("click", function () {
      window.location.href = baseUrl + "connexion";
    });
  }

  // Redirection logo accueil
  const logoAccueil = document.getElementById("logo_accueil");
  if (logoAccueil) {
    logoAccueil.onclick = function () {
      window.location.href = baseUrl + "accueil";
    };
  }

  // Redirection notifications et profil
  const notif = document.getElementById("notifications");
  if (notif) {
    notif.onclick = function () {
      window.location.href = baseUrl + "notifications";
    };
  }

  const profil = document.getElementById("profil");
  if (profil) {
    profil.onclick = function () {
      window.location.href = baseUrl + "profil";
    };
  }
});
