<section class="headerPages"> 
    <nav class="breadcrumb">
      <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumb__item">Accueil</a>
      <span class="breadcrumb__separator">></span>
      <span class="breadcrumbitem active">Evenements</span>
    </nav>
    <h1 class="politique__title">Nos Evenements</h1>
  </section>

<div class="container-event">
  <div class="events-grid">
    <div class="event-card">
      <img src="src/assets/Images/pic01.jpg" alt="Festival zéro déchets" class="event-img">
      <div class="event-content">
        <div class="event-title">Festival zéro déchets</div>
        <div class="event-desc">Quiz, jeux, concours</div>
        <div class="event-footer">
          <span class="event-free">Gratuit</span>
          <span class="event-date">18/09/25</span>
        </div>
      </div>
    </div>
    <div class="event-card">
      <img src="src/assets/Images/pic02.jpg" alt="Collecte communautaire" class="event-img">
      <div class="event-content">
        <div class="event-title">Collecte communautaire</div>
        <div class="event-desc">Gob-objets, récolte</div>
        <div class="event-footer">
          <span class="event-free">Gratuit</span>
          <span class="event-date">28/09/25</span>
        </div>
      </div>
    </div>
    <div class="event-card">
      <img src="src/assets/Images/pic03.jpg" alt="Sensibilisation au recyclage" class="event-img">
      <div class="event-content">
        <div class="event-title">Sensibilisation au recyclage</div>
        <div class="event-desc">Conférences, jeux, cadeaux</div>
        <div class="event-footer">
          <span class="event-free">Gratuit</span>
          <span class="event-date">12/10/25</span>
        </div>
      </div>
    </div>
    <div class="event-card">
      <img src="src/assets/Images/pic04.jpg" alt="Ventes d’objets de seconde main" class="event-img">
      <div class="event-content">
        <div class="event-title">Ventes d’objets de seconde main</div>
        <div class="event-desc">Vente, Seconde main</div>
        <div class="event-footer">
          <span class="event-free">Gratuit</span>
          <span class="event-date">02/11/25</span>
        </div>
      </div>
    </div>
    <div class="event-card">
      <img src="src/assets/Images/pic05.jpg" alt="Mise en place tri sur le campus" class="event-img">
      <div class="event-content">
        <div class="event-title">Mise en place tri sur le campus</div>
        <div class="event-desc">Mise en place de poubelle</div>
        <div class="event-footer">
          <span class="event-free">Gratuit</span>
          <span class="event-date">21/11/25</span>
        </div>
      </div>
    </div>
    <div class="event-card">
      <img src="src/assets/Images/pic06.jpg" alt="Atelier manuel sur le recyclage" class="event-img">
      <div class="event-content">
        <div class="event-title">Atelier manuel sur le recyclage</div>
        <div class="event-desc">Fun, amusement, rigolade</div>
        <div class="event-footer">
          <span class="event-free">Gratuit</span>
          <span class="event-date">03/01/25</span>
        </div>
      </div>
    </div>
  </div>

  <div class="section-title-event">NOS ENJEUX</div>
  <div class="challenges-event">
    <div class="challenge-event">
      <img src="src/assets/Images/pic01.jpg" alt="Challenge environnemental" class="challenge-img">
      <div class="challenge-title">POURQUOI PARTICIPER À NOS ÉVÉNEMENTS ?</div>
      <div class="challenge-desc">
        Nos événements sont conçus pour sensibiliser, éduquer et mobiliser toute la communauté universitaire autour du recyclage et de la réutilisation. Que ce soit pour apprendre, échanger ou s’amuser, chaque activité est une opportunité de contribuer à un campus plus durable.
      </div>
    </div>
    <div class="challenge-event">
      <img src="src/assets/Images/pic02.jpg" alt="Challenge solidaire" class="challenge-img">
      <div class="challenge-title">COMMENT S’IMPLIQUER ?</div>
      <div class="challenge-desc">
        Participer à nos événements, c’est simple ! Inscrivez-vous en un clic, invitez vos amis, et venez avec votre enthousiasme. Ensemble, nous pouvons réduire les déchets, partager des ressources et créer une communauté plus solidaire. Chaque geste compte pour un avenir plus vert !
      </div>
    </div>
  </div>
</div>

<!-- Overlay -->
<div id="event-overlay" class="event-overlay">
  <div class="event-popup">
    <span id="close-popup" class="event-popup-close">&times;</span>
    <img id="event-popup-img" src="" alt="" class="event-popup-img">
    <div class="event-popup-content">
      <h2 id="event-popup-title"></h2>
      <div id="event-popup-desc"></div>
      <form class="event-popup-form">
        <input type="email" placeholder="Votre adresse mail" class="event-popup-input">
        <button type="submit" class="event-popup-btn">S’inscrire</button>
      </form>
    </div>
  </div>
</div>


<script src="src/assets/event.js"></script>



