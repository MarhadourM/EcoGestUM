<?php
require_once $_ENV['BASE_URL'] .'src/model/utilisateur_model.php';

// Sécuriser et vérifier les données POST
if (!empty($_POST['identifiant']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['motdepasse']) && !empty($_POST['email'])) {

    // EXEMPLE : étudiant par défaut (idrole = 1), ou adapter selon le besoin
    $idrole = 1;
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    // Renseigne iduniv (ou autres champs nécessaires selon ta structure)
    $iduniv = 1;    // A ADAPTER ou récupérer depuis le formulaire
    
    // Appelle la fonction du modèle
    $result = inscription_utilisateur($nom, $prenom, $email, $mdp, $iduniv, null, null, $idrole);

    if ($result) {
        // Inscription réussie, redirige vers connexion ou vers l'accueil !
        header('Location: '.$_ENV['BASE_URL'].'connexion');
        exit();
    } else {
        // Erreur d'insertion
        echo "Erreur lors de l'inscription. Essayez un autre email.";
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
