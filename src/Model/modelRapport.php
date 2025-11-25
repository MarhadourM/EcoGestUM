<?php

require_once __DIR__ . '/modelBDD.php';

function getRapports() {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        SELECT 
            r.id_rapport,
            r.nom_rapport,
            r.desc_rapport,
            nom_periode ,
            r.date_creation,
            u.nom_ut,
            u.pren_ut
        FROM RAPPORT r
        JOIN UTILISATEUR u ON r.id_ut = u.id_ut
        JOIN  PERIODE on r.id_periode = PERIODE.id_periode
        ORDER BY r.date_creation DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ajouterRapport($nom, $description, $periode, $id_ut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        INSERT INTO RAPPORT (nom_rapport, date_creation,desc_rapport, id_periode, id_ut)
        VALUES (?, NOW(), ?, ?, ?)
    ");
    return $stmt->execute([$nom, $description, $periode, $id_ut]);
}

function getRapportById($id_rapport) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("
        SELECT 
            r.id_rapport,
            r.nom_rapport,
            r.description_rapport,
            r.periode_rapport,
            r.date_creation,
            u.nom_ut,
            u.pren_ut
        FROM RAPPORT r
        JOIN UTILISATEUR u ON r.id_ut = u.id_ut
        WHERE r.id_rapport = ?
    ");
    $stmt->execute([$id_rapport]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function supprimerRapport($id_rapport) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("DELETE FROM RAPPORT WHERE id_rapport = ?");
    return $stmt->execute([$id_rapport]);
}


function existeRapportParNom($nom) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM RAPPORT WHERE nom_rapport = ?");
    $stmt->execute([$nom]);
    return $stmt->fetchColumn() > 0;
}

?>