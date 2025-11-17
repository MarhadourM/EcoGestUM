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




?>