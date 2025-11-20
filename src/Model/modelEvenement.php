<?php

require_once 'modelBDD.php';

function getEvents() {
    $pdo = get_bdd();
    $sql = "
        SELECT 
            id_event,
            nom_event,
            desc_event,
            date_event,
            prix_event
        FROM
            evenement
        ORDER BY
            date_event ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>