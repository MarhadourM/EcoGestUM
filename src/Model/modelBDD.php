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

function get_objets_disponibles($page = 1, $parPage = 9) {
    $pdo = get_bdd();
    $offset = ($page - 1) * $parPage;
    // Insère directement $offset et $parPage dans la requête
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
        WHERE o.id_statut_recyclage_obj = 1
        ORDER BY o.date_obj_recycl DESC
        LIMIT $offset, $parPage
    ";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function get_nb_objets_disponibles() {
    $pdo = get_bdd();
    $stmt = $pdo->query("
        SELECT COUNT(*) as total
        FROM objet_recyclable
        WHERE id_statut_recyclage_obj = 1
    ");
    return $stmt->fetch()['total'];
}


?>
