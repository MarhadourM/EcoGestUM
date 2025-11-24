<?php
require_once __DIR__ . '/../Model/modelBDD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_res'])) {
    $id_res = (int)$_POST['id_res'];
    $pdo = get_bdd();
    // Permet juste au user de supprimer SA réservation (sécurité)
    $user_id = $_SESSION['user']['id_ut'] ?? null;
    if ($user_id) {
        // Vérifie que la réservation appartient à l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM reservation WHERE id_res = ? AND id_ut = ?");
        $stmt->execute([$id_res, $user_id]);
        envoyer_notification($idUt, "Un objet a été supprimé de vos réservations. \nCause : Objet récupéré ", 2);
        header('Location: mesReservations?success_recup=1');
        exit;
    }
}
// Sinon redirige sans message
header('Location:mesReservations');
exit;
?>
