<?php 
require_once __DIR__ . '/../../Model/model-statisitique-rapport.php';
 $nb_nouv_obj = getNewObjParMoisAuto();
 $nb_obj_recycles = getObjRecyclesParMois();   
 $nb_events = getNbeventsParMois();
 $rapports = getLastRapports();
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
    <div class="rapports-list">
        <?php foreach ($rapports as $rapport): ?>
        <a href="<?php echo htmlspecialchars($rapport['lien']); ?>" class="rapport-item">
            <span class="rapport-icon"></span>
            <?php echo htmlspecialchars($rapport['nom']); ?>
        </a>
        <?php endforeach; ?>
    </div>
    <button class="dashboard-btn-gen">GÉNÉRER UN RAPPORT</button>
    </div>

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