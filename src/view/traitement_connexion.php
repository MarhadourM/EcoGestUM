<?php
require_once $_ENV['BASE_URL'] .'src/model/utilisateur_model.php';
session_start();

if (!empty($_POST['email']) && !empty($_POST['motdepasse'])) {

    $email = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    // Cherche l'utilisateur et vérifie le mot de passe
    $user = connexion_utilisateur($email, $mdp);

    if ($user) {
        // Authentification réussie, on stocke les données utiles en session
        $_SESSION['user'] = [
            'idut' => $user['idut'],
            'nomut' => $user['nomut'],
            'prenomut' => $user['pronut'],
            'emailut' => $user['emailut'],
            'roles' => $user['roles']
        ];
        // Redirection vers l'accueil ou le dashboard
        header('Location: '.$_ENV['BASE_URL']);
        exit();
    } else {
        // Erreur d'identifiants
        echo "Email ou mot de passe incorrect.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>
