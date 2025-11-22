<?php 
require_once __DIR__ . '/../../Model/model-statisitique-rapport.php';
 $nb_nouv_obj = getNewObjParMoisAuto();
 $nb_obj_recycles = getObjRecyclesParMois();   
 $nb_events = getNbeventsParMois();
 $mois = date('n');
$annee = date('Y');
?>


<div class="dashboard-main-content">
    <div class="dashboard-top">
    <!-- Statistiques principales -->
    <div class="stats-cards">
    <div class="stat-card">
        <div class="stat-title">Nouveaux objets récupérés</div>
        <div class="stat-value"><?php echo $nb_nouv_obj; ?></div>
        <div class="stat-desc">
        En <?php echo getNomMois($mois); ?> <?php echo $annee; ?>, <?php echo $nb_nouv_obj; ?> nouveaux objets reçus
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Objets recyclés</div>
        <div class="stat-value"><?php echo $nb_obj_recycles; ?></div>
        <div class="stat-desc">
        En <?php echo getNomMois($mois); ?> <?php echo $annee; ?>, <?php echo $nb_obj_recycles; ?> objets recyclés
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-title">Événements sur le recyclage</div>
        <div class="stat-value"><?php echo $nb_events; ?></div>
        <div class="stat-desc">
        En <?php echo getNomMois($mois); ?> <?php echo $annee; ?>, <?php echo $nb_events; ?> événements organisés
        </div>
    </div>
    </div>
    </div>

    <!-- Derniers rapports -->
   <div class="dashboard-rapports">
  <div class="rapports-title">VOS DERNIERS RAPPORTS</div>
  <div class="rapports-list-cols">
    <a href="files/rapport_trim1.pdf" class="rapport-item" download>
      <span class="rapport-icon pdf"></span>
      Rapport statistiques trim1.pdf
      <span class="rapport-icon dl"></span>
    </a>
    <a href="files/rapport_trim2.pdf" class="rapport-item" download>
      <span class="rapport-icon pdf"></span>
      Rapport statistiques trim2.pdf
      <span class="rapport-icon dl"></span>
    </a>
    <a href="files/rapport_sem2.pdf" class="rapport-item" download>
      <span class="rapport-icon pdf"></span>
      Rapport statistiques sem2.pdf
      <span class="rapport-icon dl"></span>
    </a>
    <a href="#rapport" class="dashboard-btn-gen">
      <span class="rapport-icon pdf"></span>
      GÉNÉRER UN RAPPORT
      <span class="rapport-icon dl"></span>
    </a>
  </div>
</div>

    <!-- Bas de page du dashboard -->

    <div class="dashboard-bas">
    <div class="dashboard-card">
        <div class="card-title">Meilleur mois de recyclage</div>
        <div class="card-desc"><?php echo htmlspecialchars($best['desc']); ?></div>
        <button class="dashboard-btn">Statistiques</button>
    </div>
    <div class="dashboard-card card-comm">
        <div class="card-title comm-title">Communications officielles</div>
        <div class="card-desc comm-desc">
        Envoyez des actualités, rapports, campagnes de sensibilisation
        </div>
        <button class="dashboard-btn comm-btn">Communication</button>
    </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>