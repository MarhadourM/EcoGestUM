<?php
function get_bdd(){
    $hostname = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    $db_name = $_ENV['DB_NAME'];

    $dsn = "mysql:host=$hostname;dbname=$db_name;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);
    return $pdo;
}

function get_universites() {
    $pdo = get_bdd();
    // Table UNIVERSITE (id_univ, nom_univ)
    $stmt = $pdo->query("SELECT id_univ, nom_univ FROM universite");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_composantes() {
    $pdo = get_bdd();
    // Table COMPOSANTE (id_comp, nom_comp)
    $stmt = $pdo->query("SELECT id_comp, nom_comp FROM composante");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_departements() {
    $pdo = get_bdd();
    // Table DEPARTEMENT (id_dept, nom_dept)
    $stmt = $pdo->query("SELECT id_dept, nom_dept FROM departement");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
