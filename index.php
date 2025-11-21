<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

$page = $_GET['page'] ?? 'accueil';
// Router les pages
switch ($page) {
    case 'accueil':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/accueil.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
    
    case 'connexion':
        require_once __DIR__ . '/src/view/connexion.php';
        break;
    
    case 'inscription':
        require_once __DIR__ . '/src/view/inscription.php';
        break;
    case 'mot-de-passe-oublie.php':
        require_once __DIR__ . '/src/view/mdpOublie.php';
        break;
    case 'traitement_connexion':
        require_once __DIR__ . '/src/view/traitement_connexion.php';
        break;
     case 'deconnexion':
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . getenv('BASE_URL') . 'accueil');
        break;
    case 'traitement_inscription':
        require_once __DIR__ . '/src/view/traitement_inscription.php';
        break;
    case 'profil':
        require_once __DIR__ . '/src/view/profil.php';
        break;
    case 'notifications':
        require_once __DIR__ . '/src/view/notifications.php';
        break;
    case 'statistiques':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/statistiques.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
    
    case 'notre-politique':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/notre-politique.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
    
    case 'espace-reprise':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/espace-reprise.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';

        break;
    
    case 'evenements':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/evenements.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
     case 'carte':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/carte.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
    
    case 'messagerie':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/messagerie.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'objectifs':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/objectifs.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
    
    
    case 'rechercheObjet':
        require_once __DIR__ . '/src/controller/rechercheObjetController.php';

        // Si c'est une action de réservation, traite-la AVANT TOUT AFFICHAGE !
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reserver') {
            reserver_objet_action();
            // header('Location...') fait exit, donc rien ne s’affiche après
        }

        require_once __DIR__ . '/src/view/Templates/header.php';
        afficher_recherche_objet(); // La page affichée si GET ou après la redirection
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'formDon':
        require_once __DIR__.'/src/view/formDon.php';
        break;
        
    case 'traitement_formDon':
        require_once __DIR__.'/src/controller/formDonController.php';
        break;

    case 'dashboard':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/Templates/menu-dashboard.php';
        require_once __DIR__ . '/src/view/dashboard.php';
        break;

    case 'dashboard-impact':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/Templates/menu-dashboard.php';
        require_once __DIR__ . '/src/view/Dashboard/presidence-impact.php';
        break;
    
    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}
?>