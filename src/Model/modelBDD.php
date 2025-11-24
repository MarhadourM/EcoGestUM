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

function get_objets_disponibles($page = 1, $parPage = 9, $search = '', $etat = '', $categorie = '') {
    $pdo = get_bdd();
    $offset = ($page - 1) * $parPage;
    $where = "WHERE o.id_statut_recyclage_obj = 1";
    if ($search !== '') {
        $where .= " AND (o.nom_obj_recycl LIKE :search OR o.desc_obj_recycl LIKE :search)";
    }
    if ($etat !== '') {
        $where .= " AND o.id_etat_obj = :etat";
    }
    if ($categorie !== '') {
        $where .= " AND o.id_cat_obj = :categorie";
    }
    $sql = "
        SELECT 
            o.id_obj_recycl,
            o.nom_obj_recycl,
            o.desc_obj_recycl,
            o.loca_obj_recycl,
            o.date_obj_recycl,
            et.nom_etat_obj,
            cat.nom_cat_obj,
            p.lien_photo
        FROM objet_recyclable o
        INNER JOIN photo_objet po ON o.id_obj_recycl = po.id_obj_recycl
        INNER JOIN photo p ON po.id_photo = p.id_photo
        INNER JOIN etat_objet et ON o.id_etat_obj = et.id_etat_obj
        INNER JOIN categorie_objet cat ON o.id_cat_obj = cat.id_cat_obj
        $where
        ORDER BY o.date_obj_recycl DESC
        LIMIT $offset, $parPage
    ";
    $stmt = $pdo->prepare($sql);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($etat !== '') $stmt->bindValue(':etat', $etat);
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function get_nb_objets_disponibles($search = '', $etat = '', $categorie = '') {
    $pdo = get_bdd();
    $where = "WHERE o.id_statut_recyclage_obj = 1";
    if ($search !== '') $where .= " AND (o.nom_obj_recycl LIKE :search OR o.desc_obj_recycl LIKE :search)";
    if ($etat !== '') $where .= " AND o.id_etat_obj = :etat";
    if ($categorie !== '') $where .= " AND o.id_cat_obj = :categorie";
    $sql = "
        SELECT COUNT(*) as total
        FROM objet_recyclable o
        INNER JOIN photo_objet po ON o.id_obj_recycl = po.id_obj_recycl
        INNER JOIN photo p ON po.id_photo = p.id_photo
        INNER JOIN etat_objet et ON o.id_etat_obj = et.id_etat_obj
        INNER JOIN categorie_objet cat ON o.id_cat_obj = cat.id_cat_obj
        $where
    ";
    $stmt = $pdo->prepare($sql);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($etat !== '') $stmt->bindValue(':etat', $etat);
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return (int)$stmt->fetch()['total'];
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

function ajouter_objet_recyclable($categorie, $nom, $description, $localisation, $etat) {
    $pdo = get_bdd();
    $sql = "INSERT INTO objet_recyclable (id_cat_obj, nom_obj_recycl, desc_obj_recycl, loca_obj_recycl, id_etat_obj, id_statut_recyclage_obj, date_obj_recycl)
            VALUES (?, ?, ?, ?, ?, 1, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categorie, $nom, $description, $localisation, $etat]);
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
    $stmt->execute([':id_Obj' => $id_Obj]);
    return $stmt->fetchColumn();
}



?>
