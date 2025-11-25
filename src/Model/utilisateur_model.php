<?php require_once 'modelBDD.php';


function get_users(){
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function inscription_utilisateur($nom, $prenom, $email, $mdp, $id_univ, $id_comp, $id_dept, $idrole = 1) {
    $pdo = get_bdd();
    $pdo->beginTransaction();
    try {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            "INSERT INTO UTILISATEUR (nom_ut, pren_ut, email_ut, mdp_ut, id_univ, id_comp, id_dept)
                VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nom, $prenom, $email, $hash, $id_univ, $id_comp, $id_dept]);
        $id_ut = $pdo->lastInsertId();

        $stmtRole = $pdo->prepare("INSERT INTO ROLE_UTILISATEUR (id_role, id_ut) VALUES (?, ?)");
        $stmtRole->execute([$idrole, $id_ut]);

        $pdo->commit();
        return $id_ut;
    } catch(Exception $e){
        $pdo->rollBack();
        echo "Erreur SQL : " . $e->getMessage(); 
        return false;
    }
}


function connexion_utilisateur($email, $motdepasse) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email_ut=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && ($user['mdp_ut'] === $motdepasse || password_verify($motdepasse, $user['mdp_ut']))) {
        // Chercher les rôles
        $stmtRole = $pdo->prepare("SELECT id_role FROM ROLE_UTILISATEUR WHERE id_ut=?");
        $stmtRole->execute([$user['id_ut']]);
        $roles = $stmtRole->fetchAll(PDO::FETCH_COLUMN);

        $user['roles'] = $roles;
        return $user;
    }
    return false;
}

function email_existe($email) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE email_ut=?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function get_nom_role($id_role) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT nom_role FROM roles WHERE id_role = ?");
    $stmt->execute([$id_role]);
    return $stmt->fetchColumn();
}


?>