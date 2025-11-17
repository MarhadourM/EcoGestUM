<?php
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


//require_once __DIR__ . '/src/view/Templates/header.php';
//require_once __DIR__ . '/src/view/Templates/footer.php';
 require_once __DIR__ . '/src/Model/modelBDD.php';
 require_once __DIR__ . '/src/Model/modelEvenment.php';

?>