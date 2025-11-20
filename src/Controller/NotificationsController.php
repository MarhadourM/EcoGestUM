<?php
require_once __DIR__ . '/../model/modelNotif.php';
$user_id = $_SESSION['user']['id_ut'] ?? null;
$notifications = [];
if ($user_id) {
    $notifications = get_notifs_user($user_id);
}
        

?>