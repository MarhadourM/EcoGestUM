<?php require_once __DIR__ . '/../Model/modelObjectif.php';?>
<section class="headerPages"> 
    <nav class="breadcrumb">
        <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumb__item">Accueil</a>
        <span class="breadcrumb__separator">></span>
        <a href="<?php echo getenv('BASE_URL'); ?>notre-politique" class="breadcrumb__item">Notre politique</a>
        <span class="breadcrumb__separator">></span>
        <span class="breadcrumbitem active">Objectifs du moments</span>
    </nav>
    <h1 class="politique__title">Objectifs</h1>
</section>

<div class="objectifs-container">
<?php $objectifs = getObjectifs(); ?>
<?php foreach ($objectifs as $objectif): ?>
  <div class="objectif-card objectif-<?php echo strtolower(str_replace([' ', 'é'], ['-', 'e'], $objectif['statut'])); ?>">
    <h2 class="objectif-title">
      <?php echo htmlspecialchars($objectif['nom_objectif']); ?>
    </h2>
    <p class="objectif-desc">
      <?php echo nl2br(htmlspecialchars($objectif['desc_objectif'])); ?>
    </p>
    <div class="objectif-progress-label">
      État : <span class="etat-label"><?php echo ucfirst($objectif['statut']); ?></span>
    </div>
  </div>
<?php endforeach; ?>
</div>

