<!-- Header large sur toute la page -->
<section class="headerPages">
  <nav class="breadcrumb">
    <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
    <span class="breadcrumbseparator">&gt;</span>
    <span class="breadcrumbitem active">Notre politique</span>
  </nav>
  <h1 class="politique__title">Notre engagement sur le recyclage au sein de nos services : Notre politique environnementale</h1>
</section>

<!-- Contenu principal centré -->
<main class="main-content">
  <!-- Répartition des déchets -->
  <section class="stats-card">
    <div class="stats-flex">
      <img src="src/assets/Images/piechart_dechets.png" alt="Répartition des déchets" class="stats-img">
      <div class="stats-desc">
        <h2 class="stats-title">La repartition des déchets</h2>
        <p>En 2023, la répartition des déchets à l’université du Mans montre que le plastique purs/seuls se séparent la plus grande part (32 %), suivis des papiers/cartons (22 %) et du verre (13 %).</p>
      </div>
    </div>
  </section>

  <!-- Évolution mensuelle -->
  <section class="stats-card">
    <div class="stats-flex">
      <div class="stats-desc">
        <h2 class="stats-title">L’évolution mensuelle des déchets recyclés</h2>
        <p>En 2023, les déchets recyclés à l’université du Mans ont varié selon le mois. Les pics en septembre et octobre (jusqu’à 20 tonnes) sont attribués à l’accueil et la campagne de sensibilisation.</p>
        <p>Une série d’actions ciblées semble affluer une baisse-clé au cœur de l’année.</p>
      </div>
      <img src="src/assets/Images/bar_chart_dechets.png" alt="Déchets recyclés mensuels" class="stats-img">
    </div>
  </section>

  <!-- Impact sensibilisation -->
  <section class="stats-card">
    <div class="stats-flex">
      <img src="src/assets/Images/bar_chart_sensi.png" alt="Impact sensibilisation" class="stats-img">
      <div class="stats-desc">
        <h2 class="stats-title">L’impact des actions de sensibilisation</h2>
        <p>Les actions de sensibilisation ont boosté le recyclage en fin d’année. Grâce à l’engagement des clubs et du staff, le tri sur le campus s’est amélioré. Ces résultats traduisent le bénéfice du réseau d’acteurs sur le tri du campus.</p>
      </div>
    </div>
  </section>

  <!-- Bloc rapports -->
  <div class="report-card">
  <div class="report-main">
    <span class="report-ico">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
        <rect width="20" height="22" x="2" y="1" rx="3" fill="white"/>
        <rect x="5.5" y="5.5" width="13" height="2" rx="1" fill="#e2e4e9"/>
        <rect x="5.5" y="10" width="7" height="2" rx="1" fill="#e2e4e9"/>
      </svg>
    </span>
    <span class="report-name">Rapport_statistiques_univ_lemans_2024.pdf</span>
  </div>
  <a class="report-download" href="rapports/Rapport_statistiques_univ_lemans_2024.pdf" download>
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
      <rect width="24" height="24" rx="6" fill="white"/>
      <path d="M12 7v7m0 0l3-3m-3 3l-3-3" stroke="#c63718" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      <rect x="6" y="17" width="12" height="2" rx="1" fill="#c63718"/>
    </svg>
  </a>
</div>

</main>
