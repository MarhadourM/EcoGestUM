<?php
require_once __DIR__ . '/../model/utilisateur_model.php';

if (
    !empty($_POST['email']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['motdepasse']) &&
    !empty($_POST['iduniv']) &&
    !empty($_POST['idcomp']) &&
    !empty($_POST['iddept'])
) {
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['motdepasse'];
    $idrole = 1; // étudiant par défaut
    $iduniv = $_POST['iduniv'];
    $idcomp = $_POST['idcomp'];
    $iddept = $_POST['iddept'];

    $result = inscription_utilisateur($nom, $prenom, $email, $mdp, $iduniv, $idcomp, $iddept, $idrole);

    if ($result) {
        header('Location: ' . $_ENV['BASE_URL'] . 'connexion');
        exit();
    } else {
        echo "Erreur lors de l'inscription. Essayez un autre email.";
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
