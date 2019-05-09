<?php
require_once 'db_functions.php';
$db = new db_functions();


    $banners = $db->getBanner();
    echo json_encode($banners);
