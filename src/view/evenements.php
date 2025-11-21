<section class="headerPages"> 
    <nav class="breadcrumb">
      <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
      <span class="breadcrumbseparator">></span>
      <span class="breadcrumbitem active">Evenements</span>
    </nav>
    <h1 class="breadcrumb_title">Nos Evenements</h1>
  </section>

<div class="events-grid">
<?php 
require_once __DIR__ . '/../Model/modelEvenement.php';
  $events = getEvents(); 
  $imgIndex = 1;
?>
<?php foreach ($events as $event): ?>
  <div class="event-card"
      data-title="<?php echo htmlspecialchars($event['nom_event']); ?>"
      data-desc="<?php echo htmlspecialchars($event['desc_event']); ?>"
      data-date="<?php echo htmlspecialchars($event['date_event']); ?>"
      data-price="<?php if ($event['prix_event'] == 0) {
              echo 'Gratuit';
          } else {?>
          <?php echo htmlspecialchars($event['prix_event']).'€'; }?>"
      data-img="src/assets/Images/pic0<?php echo $imgIndex; ?>.jpg">
    <img src="src/assets/Images/pic0<?php echo $imgIndex; ?>.jpg"
         alt="Image évènement <?php echo htmlspecialchars($event['nom_event']); ?>"
         class="event-img">

    <div class="event-content">
      <div class="event-title"><?php echo htmlspecialchars($event['nom_event']); ?></div>
      <div class="event-desc"><?php echo htmlspecialchars($event['desc_event']); ?></div>
      <div class="event-footer">
        <span class="event-price">
          <?php if ($event['prix_event'] == 0) {
              echo 'Gratuit';
          } else {?>
          <?php echo htmlspecialchars($event['prix_event']).'€'; }?>
        </span>
        <span class="event-date"><?php echo htmlspecialchars($event['date_event']); ?></span>
      </div>
    </div>
  </div>
  <?php
    $imgIndex++;
    if ($imgIndex > 6) { $imgIndex = 1; }
  ?>
<?php endforeach; ?>
</div>

 <!-- Section Nos Enjeux -->
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
    <img id="event-popup-img" src="" alt="" class="event-popup-img">
    <div class="event-popup-body">
      <span id="close-popup-event" class="event-popup-close">&times;</span>
      <h2 id="event-popup-title"></h2>
      <div id="event-popup-desc"></div>
      <div class="event-popup-infos">
        <span id="event-popup-price"></span>
        <span id="event-popup-date"></span>
      </div>
      <form class="event-popup-form">
        <input type="email" placeholder="Votre adresse mail" class="event-popup-input">
        <button type="submit" class="event-popup-btn">S’inscrire</button>
      </form>
    </div>
  </div>
</div>



<script src="src/assets/js/event.js"></script>



