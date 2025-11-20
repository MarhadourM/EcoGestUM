<?php
require_once __DIR__ . '/modelBDD.php';
function getObjectifs() {
    $pdo= get_bdd();
    $sql = "
        SELECT 
            obj.id_objectif,
            obj.nom_objectif,
            obj.desc_objectif,
            obj.date_ajout_objectif,
            statut.nom_statut_objectif AS statut
        FROM
            objectif_developpement_durable AS obj
        INNER JOIN
            statut_objectif AS statut
            ON obj.id_statut_objectif = statut.id_statut_objectif
        ORDER BY
            obj.id_objectif ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>