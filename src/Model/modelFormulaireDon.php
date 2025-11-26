<?php
require_once __DIR__ . '/modelBDD.php';

function get_etats_objet() {
    $pdo = get_bdd();
    $req = $pdo->query("SELECT id_etat_obj, nom_etat_obj FROM ETAT_OBJET");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function get_categories_objet() {
    $pdo = get_bdd();
    $req = $pdo->query("SELECT id_cat_obj, nom_cat_obj FROM CATEGORIE_OBJET");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
