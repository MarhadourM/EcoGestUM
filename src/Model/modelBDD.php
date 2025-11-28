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
    $stmt = $pdo->query("SELECT id_univ, nom_univ FROM universite");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_composantes() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_comp, nom_comp FROM composante");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_departements() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_dept, nom_dept FROM departement");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_nb_objets_reserves() {
    $pdo = get_bdd();
    $sql = "SELECT COUNT(*) AS total
            FROM objet_recyclable
            WHERE id_statut_recyclage_obj != 1"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return (int)$stmt->fetchColumn();
}

function reserver_objet($idObj, $idUt) {
    $pdo = get_bdd();

    $test = $pdo->prepare("SELECT COUNT(*) as nb FROM reservation WHERE id_obj_recycl = ?");
    $test->execute([$idObj]);
    $row = $test->fetch(PDO::FETCH_ASSOC);
    if ($row['nb'] > 0) {
        return false;
    }

    $stmt = $pdo->prepare("
        INSERT INTO reservation (date_res, date_exp_res, id_statut_res, id_obj_recycl, id_ut)
        VALUES (CURDATE(), DATE_ADD(CURDATE(), INTERVAL 14 DAY), 2, ?, ?)
    ");
    $stmt->execute([$idObj, $idUt]);

    $update = $pdo->prepare("UPDATE objet_recyclable SET id_statut_recyclage_obj = 2 WHERE id_obj_recycl = ?");
    $update->execute([$idObj]);

    return true;
}

function ajouter_objet_recyclable($categorie, $nom, $description, $localisation, $etat, $idinv) {
    $pdo = get_bdd();
    $sql = "INSERT INTO objet_recyclable (id_cat_obj, nom_obj_recycl, desc_obj_recycl, loca_obj_recycl, id_etat_obj, id_statut_recyclage_obj, date_obj_recycl, id_inv)
        VALUES (?, ?, ?, ?, ?, 1, NOW(), ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categorie, $nom, $description, $localisation, $etat, $idinv]);
    return $pdo->lastInsertId();
}

function ajouter_photo_objet($id_objet, $filename) {
    $pdo = get_bdd();
    $pdo->beginTransaction();
    $pdo->prepare("INSERT INTO photo(lien_photo) VALUES (?)")->execute([$filename]);
    $id_photo = $pdo->lastInsertId();
    $pdo->prepare("INSERT INTO photo_objet(id_photo, id_obj_recycl) VALUES (?, ?)")->execute([$id_photo, $id_objet]);
    $pdo->commit();
}

function getAuteurObjetRecyclable($idObj) {
    $pdo = get_bdd();
    $sql = "SELECT id_ut FROM FORMULAIRE_DONATION WHERE id_obj_recycl = :id_Obj";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_Obj' => $idObj]);
    return $stmt->fetchColumn();
}

function get_inventaire_by_idut($idut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_dept, id_comp, id_univ FROM utilisateur WHERE id_ut = ?");
    $stmt->execute([$idut]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($user['id_dept'])) {
        $stmt2 = $pdo->prepare("SELECT id_inv FROM departement WHERE id_dept = ?");
        $stmt2->execute([$user['id_dept']]);
        $id_inv = $stmt2->fetchColumn();
        if ($id_inv) return $id_inv;
    }
    if (!empty($user['id_comp'])) {
        $stmt2 = $pdo->prepare("SELECT id_inv FROM composante WHERE id_comp = ?");
        $stmt2->execute([$user['id_comp']]);
        $id_inv = $stmt2->fetchColumn();
        if ($id_inv) return $id_inv;
    }
    if (!empty($user['id_univ'])) {
        $stmt2 = $pdo->prepare("SELECT id_inv FROM universite WHERE id_univ = ?");
        $stmt2->execute([$user['id_univ']]);
        $id_inv = $stmt2->fetchColumn();
        if ($id_inv) return $id_inv;
    }
    return null;
}
