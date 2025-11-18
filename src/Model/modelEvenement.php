<?php

require_once 'modelBDD.php';
function get_events(){
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM EVENEMENT");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}


?>