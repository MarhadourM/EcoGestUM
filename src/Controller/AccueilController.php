<?php
require_once __DIR__ . '/../model/modelBDD.php';
$nb_objets_recycles = get_nb_objets_reserves();
$user_id = $_SESSION['user']['id_ut'] ?? null;

?>
