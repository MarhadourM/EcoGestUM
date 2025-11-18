<?php
require_once __DIR__ . '/../model/utilisateur_model.php';

if (
    !empty($_POST['identifiant']) &&
    !empty($_POST['email']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['motdepasse'])
) {
    $identifiant = $_POST['identifiant'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['motdepasse'];
    $idrole = 1; // étudiant par défaut
    $iduniv = 1; // A ADAPTER

    // Appeler fonction adaptée pour stocker identifiant ET email
    $result = inscription_utilisateur($identifiant, $nom, $prenom, $email, $mdp, $iduniv, null, null, $idrole);

    if ($result) {
        header('Location: ' . $_ENV['BASE_URL'] . 'connexion');
        exit();
    } else {
        echo "Erreur lors de l'inscription. Essayez un autre identifiant ou email.";
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
