<?php 
require_once __DIR__ . '/modelBDD.php';
function inscription_utilisateur($identifiant, $nom, $prenom, $email, $mdp, $iduniv, $idcomp = null, $iddept = null, $idrole = 1) {
    $pdo = get_bdd();
    $pdo->beginTransaction();
    try {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            "INSERT INTO UTILISATEUR (identifiantut, nomut, prenut, emailut, mdput, iduniv, idcomp, iddept)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$identifiant, $nom, $prenom, $email, $hash, $iduniv, $idcomp, $iddept]);
        $idut = $pdo->lastInsertId();

        $stmtRole = $pdo->prepare("INSERT INTO ROLEUTILISATEUR (idrole, idut) VALUES (?, ?)");
        $stmtRole->execute([$idrole, $idut]);

        $pdo->commit();
        return $idut;
    } catch(Exception $e){
        $pdo->rollBack();
        return false;
    }
}   

function connexion_utilisateur($identifiant, $motdepasse) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE identifiantut=?");
    $stmt->execute([$identifiant]);
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