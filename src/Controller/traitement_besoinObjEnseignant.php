<?php
require_once __DIR__ . '/../model/besoinEnseignant_model.php';
require_once __DIR__ . '/../model/modelNotif.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_demande_obj'])) {
    $idBesoin = (int)$_POST['id_demande_obj'];
    $idUtilisateur = $_SESSION['user']['id_ut'];

    // Met à jour le besoin avec le répondant
    updateBesoinEnseignant($idBesoin, $idUtilisateur);

    // Notification pour le répondant
    envoyer_notification($idUtilisateur, "Vous avez répondu à un besoin d'objet d'un enseignant", 1);

    // Notification pour l'auteur du besoin
    $idAuteur = getAuteurBesoin($idBesoin);
    if ($idAuteur) {
        envoyer_notification($idAuteur, "Votre besoin d'objet a reçu une réponse d'un enseignant", 2);
    }

    // Supprimer le besoin maintenant traité
    supprimerBesoinEnseignant($idBesoin);

    header('Location: ?page=besoinsObjEnseignants&success=reponse');
    exit();

} else {
    header('Location: ?page=besoinsObjEnseignants');
    exit();
}
?>
