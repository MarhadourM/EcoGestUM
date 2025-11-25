
<?php
require_once __DIR__ . '/modelBDD.php'; 


function getNewObjParMoisAuto() {
    $pdo = get_bdd();
    $jour = date('j');
    $mois = date('n');
    $annee = date('Y'); 

    $nb_jours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);

    $sql1 = "SELECT COUNT(*) FROM OBJET_RECYCLABLE WHERE MONTH(date_obj_recycl) = ? AND YEAR(date_obj_recycl) = ?";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute([$mois, $annee]);
    $nouveaux_objets = $stmt1->fetchColumn();

   setNewStatsparMois($nb_jours, 'Nouveaux objets recyclables '. getNomMois($mois) . '/' . $annee, $nouveaux_objets);
            
    return $nouveaux_objets;
}
function getObjRecyclesParMois() {
    $pdo = get_bdd();
    $jour = date('j');
    $mois = date('n');
    $annee = date('Y'); 
    $nb_jours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);

    $sql2 = "SELECT COUNT(*) FROM OBJET_RECYCLABLE WHERE MONTH(date_obj_recycl) = ? AND YEAR(date_obj_recycl) = ? AND id_statut_recyclage_obj = 3";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$mois, $annee]);
    $objets_recycles = $stmt2->fetchColumn();


    setNewStatsparMois($nb_jours, 'Objets recyclés '. getNomMois($mois) . '/' . $annee, $objets_recycles);

    return $objets_recycles;
}

function getNbeventsParMois() {
    $pdo = get_bdd();
    $jour = date('j');
    $mois = date('n');
    $annee = date('Y'); 
    $nb_jours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);

    $sql3 = "SELECT COUNT(*) FROM EVENEMENT WHERE MONTH(date_event) = ? AND YEAR(date_event) = ?";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([$mois, $annee]);
    $events = $stmt3->fetchColumn();

    setNewStatsparMois($nb_jours, 'Evenements'. getNomMois($mois) . '/' . $annee, $events);

    return $events;
}


function setNewStatsparMois($nb_jours,$titreStats, $nouveaux_objets) {
    $pdo = get_bdd();
    $jour = date('j');
    if($jour == $nb_jours){

        $sql = "INSERT INTO STATISTIQUES (nom_stats, val_stats,id_periode) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $titreStats,
            $nouveaux_objets,
            1
        ]);
        }
}


function getNomMois($mois) {
    $noms = [
        1 => "janvier", 2 => "février", 3 => "mars", 4 => "avril", 5 => "mai",
        6 => "juin", 7 => "juillet", 8 => "août", 9 => "septembre",
        10 => "octobre", 11 => "novembre", 12 => "décembre"
    ];
    return $noms[intval($mois)];
    
}



?>
    