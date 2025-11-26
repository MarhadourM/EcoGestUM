<?php

require_once __DIR__ . '/modelBDD.php';

function getCommunications() {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        SELECT 
            c.id_comm,
            c.titre_comm,
            c.contenu_comm,
            c.date_comm,
            u.nom_ut,
            u.pren_ut
        FROM COMMUNICATION_OFFICIELLE c
        JOIN UTILISATEUR u ON c.id_ut = u.id_ut
        ORDER BY c.date_comm DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCommunicationById($id_comm) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        SELECT 
            c.id_comm,
            c.titre_comm,
            c.contenu_comm,
            c.date_comm,
            u.nom_ut,
            u.pren_ut,
            u.id_ut
        FROM COMMUNICATION_OFFICIELLE c
        JOIN UTILISATEUR u ON c.id_ut = u.id_ut
        WHERE c.id_comm = ?
        order by c.date_comm DESC
    ");
    $stmt->execute([$id_comm]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ajouterCommunication($titre, $contenu, $id_ut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        INSERT INTO COMMUNICATION_OFFICIELLE (titre_comm, contenu_comm, date_comm, id_ut)
        VALUES (?, ?, NOW(), ?)
    ");
    return $stmt->execute([$titre, $contenu, $id_ut]);
}

function supprimerCommunication($id_comm) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("DELETE FROM COMMUNICATION_OFFICIELLE WHERE id_comm = ?");
    return $stmt->execute([$id_comm]);
}
?>