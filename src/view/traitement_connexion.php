<?php
require_once __DIR__ . '/../model/utilisateur_model.php';

session_start();

if (!empty($_POST['identifiant']) && !empty($_POST['motdepasse'])) {
    $id = $_POST['identifiant'];
    $mdp = $_POST['motdepasse'];

    $user = connexion_utilisateur($id, $mdp);

    if ($user) {
        $_SESSION['user'] = [
            'idut' => $user['idut'],
            'nomut' => $user['nomut'],
            'prenomut' => $user['prenomut'],
            'emailut' => $user['emailut'],
            'roles' => $user['roles']
        ];
        header('Location: '.$_ENV['BASE_URL']);
        exit();
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}

?>
