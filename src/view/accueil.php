<?php
require_once __DIR__ . '/../model/modelBDD.php';
$nb_objets_recycles = get_nb_objets_reserves();
?>

<main class="main-content">
    <!-- Section Hero avec compteur -->
    <section class="hero-section" style="background-image: url('<?php echo getenv('BASE_URL')."src/assets/Images/ObjRecyclTotalImg.png"; ?>');">
        <div class="counter-card">
            <div class="counter-label">Déjà</div>
            <div class="counter-number"><?= $nb_objets_recycles ?></div>
            <div class="counter-text">objets recyclés</div>
        </div>
    </section>

    <!-- Section Donation Campus & Moi -->
    <section class="donation-section">
        <div class="donation-card">
            <img src="<?php echo getenv('BASE_URL')."src/assets/Images/FormulaireDonAcceuil.png"; ?>" alt="Campus & Moi" class="donation-icon">
            <button class="donation-btn">Formulaire de donation</button>
        </div>
        <div class="donation-content">
            <h2>Vous avez des objets en bon état dont vous ne vous servez plus ?</h2>
            <p>Donnez-les pour qu'ils puissent être réutilisés par d'autres membres de l'université !</p>
        </div>
    </section>

    <!-- Section Pourquoi nous battons nous -->
    <section class="why-section">
        <h2 class="why-title">Pour quoi nous battons nous ?</h2>
        <div class="why-cards">
            <div class="why-card">
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a" alt="Notre politique d'entraide" class="why-card-image">
                <div class="why-card-content">
                    <h3 class="why-card-title">Notre politique d'entraide</h3>
                    <p class="why-card-text">Avec EcoGestUM, nous encourageons le partage et la réutilisation des objets entre étudiants. Notre politique vise à réduire les déchets et à favoriser l'accès aux ressources pour tous. Ensemble, construisons un campus plus solidaire et durable !</p>
                    <button class="why-card-btn">Voir notre Politique</button>
                </div>
            </div>
            <div class="why-card">
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09" alt="Réduction impact carbone" class="why-card-image">
                <div class="why-card-content">
                    <h3 class="why-card-title">Réduction impact carbone</h3>
                    <p class="why-card-text">Avec EcoGestUM, nous encourageons le recyclage et la réutilisation d'un réduire les déchets et les émissions de CO₂. Chaque objet sauvé, c'est un pas de plus vers un campus plus vert et responsable. Ensemble, agissons pour un avenir durable !</p>
                    <button class="why-card-btn">Voir les Statistiques</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Points de collecte -->
    <section class="collect-section">
        <h2 class="collect-title">RENDEZ-VOUS À NOS POINTS DE COLLECTE</h2>
        <p class="collect-text">Découvrez nos points de collectes et de distribution d'objets et matériaux sur notre carte interactive</p>
        <button class="collect-btn">Voir la Carte</button>
    </section>
</main>

<script>
    // Animation du compteur
    function animateCounter() {
        const counter = document.querySelector('.counter-number');
        const target = <?= (int)$nb_objets_recycles ?>;
        const duration = 2000;
        const steps = 60;
        const increment = target / steps;
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString('fr-FR');
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString('fr-FR');
            }
        }, duration / steps);
    }

    // Lancer l'animation au chargement
    window.addEventListener('load', animateCounter);

    // Gestion des boutons
    document.querySelector('.donation-btn').addEventListener('click', function() {
        window.location.href = "<?php echo getenv('BASE_URL'); ?>formulaire-donation";
    });

    document.querySelectorAll('.why-card-btn').forEach((btn, index) => {
        btn.addEventListener('click', function() {
            if (index === 0) {
                window.location.href = "<?php echo getenv('BASE_URL'); ?>notre-politique";
            } else {
                window.location.href = "<?php echo getenv('BASE_URL'); ?>statistiques";
            }
        });
    });

    document.querySelector('.collect-btn').addEventListener('click', function() {
        window.location.href = "<?php echo getenv('BASE_URL'); ?>carte";
    });
</script>

