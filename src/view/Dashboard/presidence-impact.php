<?php
require_once __DIR__ . '/../../model/modelStatistiqueRapport.php';
require_once __DIR__. '/../../model/modelBDD.php';
$data = getRepartitionObjetsParCategorie();
$nb_objets_recycles = get_nb_objets_reserves();
$nb_nouv_obj = getNewObjParMoisAuto();
$mois = date('n');
$annee = date('Y');
?>

<div class="impact-stats-container">
  <!-- Cartes résumé en haut -->
  <section class="stats-summary">
    <div class="stats-card stats-black-card impact-materials">
      <span class="stats-value">25Kg</span>
      <span class="stats-label">de matériaux recyclés<br>depuis 2020</span>
    </div>
    <div class="stats-card stats-orange-card objects-recycled">
      <span class="stats-value"><?php echo $nb_objets_recycles;?></span>
      <span class="stats-label">objets recyclés<br>grâce à EcoGestUM</span>
    </div>
    <div class="stats-card stats-blue-card economics-saved">
      <span class="stats-value">100&nbsp;€</span>
      <span class="stats-label">économisé avec<br>la reprise d’objets</span>
    </div>
    <div class="stats-card stats-grey-card reuse-rate">
      <span class="stats-value">85%</span>
      <span class="stats-label">de taux de<br>réutilisation</span>
    </div>
  </section>

  <!-- Détails : recyclage par catégorie, donateurs, objets reçus -->
  <section class="stats-details">
    <div class="stats-category-recycling">
        <span class="category-title">RECYCLAGE PAR CATÉGORIE</span>
       <ul class="category-list">
  <?php foreach ($data as $item): ?>
    <li class="cat-item <?php echo strtolower(str_replace([' ', 'é'], ['-', 'e'], $item['nom_cat_obj'])); ?>">
      <?php echo htmlspecialchars($item['nom_cat_obj']); ?>
      <span class="cat-count"><?php echo number_format($item['nombre'], 0, ' ', ' '); ?></span>
    </li>
  <?php endforeach; ?>
</ul>

        <div class="recycle-piechart">
            <canvas id="repartitionChart"></canvas>
        </div>
    </div>
    <div class ="stats-details-part">
        <div class="stats-card stats-white-card stats-donors">
            <span class="donors-title">NOMBRE DE DONATEURS DE L’UNIVERSITÉ</span>
            <span class="donors-count">8&nbsp;</span>
        </div>

        <div class="stats-card stats-white-card stats-received-objects">
            <span class="received-title">OBJETS REÇUS</span>
            <span class="received-count"><?php echo $nb_objets_recycles;?></span>
            <span class="received-subtext">- <?php echo $nb_objets_recycles -1 ;?> objets réinsérés en service</span>
        </div>

        <div class="stats-monthly-objects">
      <span class="month-title"><?php echo getNomMois($mois); ?> <?php echo $annee; ?></span>
      <span class="month-value"><?php echo $nb_nouv_obj;?></span>
      <span class="month-label">Nouveaux objets</span>
      <span class="month-desc">En <?php echo getNomMois($mois); ?> <?php echo $annee; ?>, <?php echo $nb_nouv_obj;?> nouveaux objets ont été enregistrés<br>grâce à l'université</span>
    </div>
        
    </div>
    
  </section>

  <!-- Bloc mensuel objets -->
  <section class="stats-month">
    
  </section>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const repartitionData = <?php echo json_encode($data);?>;
const labels = repartitionData.map(item => item.nom_cat_obj);
const data = repartitionData.map(item => item.nombre); // <-- Utilise 'data' ensuite
const colors = ['#74C947', '#2B75F6', '#FFB946', '#F26D50', '#A57EE3'];

const ctx = document.getElementById('repartitionChart').getContext('2d');
new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: labels,
    datasets: [{
      data: data, // <-- Correction ici
      backgroundColor: colors.slice(0, data.length),
      borderWidth: 0
    }]
  },
  options: {
    plugins: {
      legend: { display: false }
    },
    cutout: '70%' // optionnelle : pour le style "donut"
  }
});

</script>
