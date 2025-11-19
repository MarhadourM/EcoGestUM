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

<main class="main-content">
  <section class="carte-section">
    <div class="carte-wrapper">
        <div id="map" class="carte-img"></div>
    </div>
    <div class="cards-lieux">
      <div class="lieu-card">
        <img src="img/campus.jpg" alt="Campus" class="lieu-img">
        <h2>Retrait campus</h2>
        <p><strong>Description :</strong><br>Récupérez facilement votre commande directement sur le campus principal à l’Avenue Olivier Messiaen.</p>
        <div class="lieu-addr">Le Mans Université, campus principal<br>Avenue Olivier Messiaen</div>
        <button class="map-btn" data-marker="campus">Voir sur maps</button>
      </div>
      <div class="lieu-card">
        <img src="img/republique.jpg" alt="République" class="lieu-img">
        <h2>Retrait place de république</h2>
        <p><strong>Description :</strong><br>Récupérez vos achats en plein centre-ville du Mans, sur la place de la République ! Accès tram, bus et nombreux commerces à proximité.</p>
        <div class="lieu-addr">13 Place de la République,<br>72000 Le Mans</div>
        <button class="map-btn" data-marker="rep">Voir sur maps</button>
      </div>
      <div class="lieu-card">
        <img src="img/saint-saturnin.jpg" alt="Saint-Saturnin" class="lieu-img">
        <h2>Retrait Saint-Saturnin</h2>
        <p><strong>Description :</strong><br>Le site parfait pour les habitants du nord de l’agglo, accès rapide via la zone commerciale et parking gratuit à proximité.</p>
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

  // Création des marqueurs AVEC VARIABLE pour accès JS
  var markers = {
    campus: L.marker([48.0115, 0.1665]).addTo(map)
      .bindPopup('<b>Le Mans Université</b><br>Campus principal<br>Avenue Olivier Messiaen'),
    rep: L.marker([48.0078, 0.1963]).addTo(map)
      .bindPopup('<b>Place de la République</b><br>13 Place de la République, 72000 Le Mans'),
    saint: L.marker([48.0606, 0.1572]).addTo(map)
      .bindPopup('<b>Retrait Saint-Saturnin</b><br>Rue de la Mairie, 72650 Saint-Saturnin')
  };

  // Ajoute listeners sur chaque bouton pour ouvrir sa popup
  document.querySelectorAll('.map-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      var key = btn.getAttribute('data-marker');
      if(markers[key]) {
        map.setView(markers[key].getLatLng(), 15, {animate:true}); // Centre la carte
        markers[key].openPopup(); // Ouvre la popup
      }
    })
  });
</script>
  