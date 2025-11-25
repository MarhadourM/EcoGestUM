<?php
require_once __DIR__ . '/../Model/modelRapport.php';

if (isset($_GET['id'])) {
    $id_rapport = (int)$_GET['id'];
    $rapport = getRapportById($id_rapport);
    if ($rapport) {
        header('Content-Type: application/json');
        echo json_encode($rapport);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Rapport non trouvé']);
    }
    exit();
}
http_response_code(400);
echo json_encode(['error' => 'ID manquant']);
