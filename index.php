<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
    
    case 'traitement_inscription':
        require_once __DIR__ . '/src/view/traitement_inscription.php';
        break;
    
    case 'statistiques':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/statistiques.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
    
    case 'notre-politique':
        require_once __DIR__ . '/view/Templates/header.php';
        require_once __DIR__ . '/view/notre-politique.php';
        require_once __DIR__ . '/view/Templates/footer.php';
        break;
    
    case 'espace-reprise':
        require_once __DIR__ . '/view/Templates/header.php';
        require_once __DIR__ . '/view/espace-reprise.php';
        require_once __DIR__ . '/view/Templates/footer.php';
        break;
    
    case 'evenements':
        require_once __DIR__ . '/view/Templates/header.php';
        require_once __DIR__ . '/view/evenements.php';
        require_once __DIR__ . '/view/Templates/footer.php';
        break;
    
    case 'messagerie':
        require_once __DIR__ . '/view/Templates/header.php';
        require_once __DIR__ . '/view/messagerie.php';
        require_once __DIR__ . '/view/Templates/footer.php';
        break;
    
    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}
?>