    <?php
    require_once __DIR__ . '/modelBDD.php';

    // Affiche les réservations de l’utilisateur qui n’ont PAS encore fait l’objet d’un signalement
    function get_user_reservations_sans_signalement($user_id) {
        $pdo = get_bdd();
        $stmt = $pdo->prepare("
            SELECT r.id_res, o.nom_obj_recycl
            FROM reservation r
            JOIN objet_recyclable o ON r.id_obj_recycl = o.id_obj_recycl
            WHERE r.id_ut = ?
            AND r.id_res NOT IN (
                SELECT id_res FROM signalement_objet
            )
            ORDER BY r.date_res DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    function getUserReservationsDetails($user_id)
    {
        $pdo = get_bdd();
        $stmt = $pdo->prepare("
            SELECT 
                r.id_res, r.date_res, r.date_exp_res,
                o.nom_obj_recycl, o.desc_obj_recycl, o.loca_obj_recycl,
                et.nom_etat_obj,
                p.lien_photo
            FROM reservation r
            JOIN objet_recyclable o ON r.id_obj_recycl = o.id_obj_recycl
            LEFT JOIN photo_objet po ON po.id_obj_recycl = o.id_obj_recycl
            LEFT JOIN photo p ON po.id_photo = p.id_photo
            LEFT JOIN etat_objet et ON o.id_etat_obj = et.id_etat_obj
            WHERE r.id_ut = ?
            AND r.id_res NOT IN (
                SELECT id_res FROM signalement_objet
            )
            ORDER BY r.date_res DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    ?>
