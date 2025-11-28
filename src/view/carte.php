<section class="headerPages">
  <nav class="breadcrumb">
    <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
    <span class="breadcrumbseparator">&gt;</span>
    <a href="<?php echo getenv('BASE_URL'); ?>espace-reprise" class="breadcrumbitem">Espace Reprise</a>
    <span class="breadcrumbseparator">&gt;</span>
    <span class="breadcrumbitem active">Carte interactive</span>
  </nav>
  <h1 class="carte__title">Carte interactive</h1>
</section>

<main class="main-content-carte">
  <section class="carte-section">
    <div class="carte-wrapper">
      <div id="map" class="carte-img"></div>
    </div>
    <div class="cards-lieux">
      <div class="lieu-card" data-card="campus">
        <img src="<?php echo getenv('BASE_URL')."src/assets/Images/campus.png"; ?>" alt="Campus" class="lieu-img">
        <h2>Retrait campus</h2>
        <p><strong>Description :</strong><br>Récupérez facilement votre commande directement sur le campus de l’Université du Mans, au cœur de la vie étudiante. Un point pratique et rapide, à deux pas de vos salles de cours et de la bibliothèque.</p>
        <div class="lieu-addr">Le Mans Université, campus principal<br>Avenue Olivier Messiaen</div>
        <button class="map-btn" data-marker="campus">Voir sur maps</button>
      </div>
<div class="lieu-card" data-card="rep">
        <img src="<?php echo getenv('BASE_URL')."src/assets/Images/rep.png"; ?>" alt="République" class="lieu-img">
        <h2>Retrait place de république</h2>
        <p><strong>Description :</strong><br> Profitez d’un retrait en plein centre-ville du Mans, sur la place de République. Idéal pour combiner vos courses, vos sorties ou un café en terrasse avec la récupération de votre commande.</p>
        <div class="lieu-addr">13 Place de la République,<br>72000 Le Mans</div>
        <button class="map-btn" data-marker="rep">Voir sur maps</button>
      </div>
      <div class="lieu-card" data-card="saint">
        <img src="<?php echo getenv('BASE_URL')."src/assets/Images/saint-sat.png"; ?>" alt="Saint-Saturnin" class="lieu-img">
        <h2>Retrait Saint-Saturnin</h2>
        <p><strong>Description :</strong><br>Un point de retrait pratique situé dans la zone commerciale de Saint-Saturnin, parfait pour récupérer votre commande en même temps que vos autres achats.</p>
        <div class="lieu-addr">Rue de la Mairie,<br>72650 Saint-Saturnin</div>
        <button class="map-btn" data-marker="saint">Voir sur maps</button>
      </div>
    </div>
  </section>
</main>
<script>
  // Création de la carte
  var map = L.map('map').setView([48.0061, 0.1996], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contribs'
  }).addTo(map);

  // Récupération du HTML des cards comme popups
  function getCardHTML(id) {
    const card = document.querySelector(`.lieu-card[data-card="${id}"]`);
    return card ? card.innerHTML : "<p>Informations non disponibles</p>";
  }

  // Création des marqueurs avec popup HTML complet
  var markers = {
    campus: L.marker([48.0115, 0.1665]).addTo(map)
      .bindPopup(getCardHTML("campus"), { maxWidth: 300 }),
    rep: L.marker([48.0078, 0.1963]).addTo(map)
      .bindPopup(getCardHTML("rep"), { maxWidth: 300 }),
    saint: L.marker([48.0606, 0.1572]).addTo(map)
      .bindPopup(getCardHTML("saint"), { maxWidth: 300 })
  };

  // Boutons "Voir sur maps" = ouvre aussi la popup
  document.querySelectorAll('.map-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      var key = btn.getAttribute('data-marker');
      if(markers[key]) {
        map.setView(markers[key].getLatLng(), 15, {animate:true});
        markers[key].openPopup();
      }
    });
  });
</script>
