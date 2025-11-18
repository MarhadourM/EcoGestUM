<?php require_once 'modelBDD.php';


function get_users(){
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function login_user($email, $password){
}

function logout_user(){
    session_destroy();
}

function inscription_utilisateur($nom, $prenom, $email, $mdp, $iduniv, $idcomp = null, $iddept = null, 
    $idrole = 1) { // idrole = 1 --> étudiant par defaut
    $pdo = get_bdd();
    $pdo->beginTransaction();
    try {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        // Insert user
        $stmt = $pdo->prepare(
            "INSERT INTO UTILISATEUR (nomut, prenut, emailut, mdput, iduniv, idcomp, iddept) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nom, $prenom, $email, $hash, $iduniv, $idcomp, $iddept]);
        $idut = $pdo->lastInsertId();

        // Associate to role
        $stmtRole = $pdo->prepare("INSERT INTO ROLEUTILISATEUR (idrole, idut) VALUES (?, ?)");
        $stmtRole->execute([$idrole, $idut]);

        $pdo->commit();
        return $idut;
    } catch(Exception $e){
        $pdo->rollBack();
        return false;
    }
}

function connexion_utilisateur($email, $motdepasse) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE emailut=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($motdepasse, $user['mdput'])) {
        // Chercher les rôles
        $stmtRole = $pdo->prepare("SELECT idrole FROM ROLEUTILISATEUR WHERE idut=?");
        $stmtRole->execute([$user['idut']]);
        $roles = $stmtRole->fetchAll(PDO::FETCH_COLUMN);

        $user['roles'] = $roles;
        return $user;
    }
    return false;
}



?>