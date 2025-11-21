<?php
require_once __DIR__ . '/modelBDD.php';

// Affiche les réservations de l’utilisateur qui n’ont PAS encore fait l’objet d’un signalement
function get_user_reservations_sans_signalement($user_id) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        SELECT r.id_res, o.nom_obj_recycl
        FROM reservation r
        JOIN objet_recyclable o ON r.id_obj_recycl = o.id_obj_recycl
        WHERE r.id_ut = ?
        AND r.id_res NOT IN (
            SELECT id_res FROM signalement_objet
        )
        ORDER BY r.date_res DESC
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
