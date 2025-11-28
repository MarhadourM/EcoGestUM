<?php
require_once __DIR__ . '/modelBDD.php';

/**
 * Récupère la liste des états d'objet.
 */
function get_etats_objet() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_etat_obj, nom_etat_obj FROM etat_objet");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère la liste des catégories d'objet.
 */
function get_categories_objet() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_cat_obj, nom_cat_obj FROM categorie_objet");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère les objets disponibles avec pagination et filtres.
 */
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

    if ($search !== '') {
        $stmt->bindValue(':search', "%$search%");
    }
    if ($etat !== '') {
        $stmt->bindValue(':etat', $etat);
    }
    if ($categorie !== '') {
        $stmt->bindValue(':categorie', $categorie);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Nombre total d'objets disponibles (pour la pagination).
 */
function get_nb_objets_disponibles($search = '', $etat = '', $categorie = '') {
    $pdo = get_bdd();

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
        SELECT COUNT(*) as total
        FROM objet_recyclable o
        INNER JOIN photo_objet po ON o.id_obj_recycl = po.id_obj_recycl
        INNER JOIN photo p ON po.id_photo = p.id_photo
        INNER JOIN etat_objet et ON o.id_etat_obj = et.id_etat_obj
        INNER JOIN categorie_objet cat ON o.id_cat_obj = cat.id_cat_obj
        $where
    ";

    $stmt = $pdo->prepare($sql);

    if ($search !== '') {
        $stmt->bindValue(':search', "%$search%");
    }
    if ($etat !== '') {
        $stmt->bindValue(':etat', $etat);
    }
    if ($categorie !== '') {
        $stmt->bindValue(':categorie', $categorie);
    }

    $stmt->execute();
    return (int)$stmt->fetch()['total'];
}
?>