<?php
require_once __DIR__ . '/../model/besoinEnseignant_model.php'; // ou le modèle dédié

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_demande_obj'])) {
    $idBesoin = (int)$_POST['id_demande_obj'];
    $idUtilisateur = $_SESSION['user']['id_ut'];

    // Exemple : marque la demande comme prise en charge, crée une entrée, envoie une notification, etc.
    // À toi de décider la logique métier (ex: ajouter une table REPONSE_BESOIN)

    // Exemple minimal :
    // updateBesoinEnseignant($idBesoin, $idUtilisateur); // À créer dans besoinEnseignant_model.php

    // Redirection :
    header('Location: ?page=besoinsObjEnseignants&success=reponse');
    exit();
} else {
    // Si appel non POST, retour sur la page principale
    header('Location: ?page=besoinsObjEnseignants');
    exit();
}
