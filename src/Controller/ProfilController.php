<?php
require_once __DIR__ . '/../model/modelBDD.php';
function get_user_info($id) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT u.*, un.nom_univ, comp.nom_comp, dept.nom_dept
                           FROM utilisateur u
                           LEFT JOIN universite un ON un.id_univ = u.id_univ
                           LEFT JOIN composante comp ON comp.id_comp = u.id_comp
                           LEFT JOIN departement dept ON dept.id_dept = u.id_dept
                           WHERE u.id_ut = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
